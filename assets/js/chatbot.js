/* ============================================================
   Chedo Tech — chat assistant widget
   Owl button above the WhatsApp button; opens a chat that asks
   /chat-api.php, which answers only about Chedo Tech.
   The conversation is kept for the browser tab (sessionStorage).
   ============================================================ */
(function () {
  "use strict";
  if (window.__chedoChat) return;
  window.__chedoChat = true;

  var CFG = window.SITE_CONFIG || {};
  var WA_NUMBER = CFG.whatsapp || "918793100815";
  var API_URL = "/chat-api.php";
  var STORE_KEY = "chedoChat.v1";
  var MAX_LEN = 500;
  var VERSION = (document.currentScript && document.currentScript.src.split("?")[1]) || "";
  var LOGO = "/assets/Aichat.webp" + (VERSION ? "?" + VERSION : "");

  var WELCOME = "Hi! 👋 I'm **Chedo Assistant**. Ask me anything about Chedo Tech — our courses, syllabus, timings, location or admissions.";
  var SUGGESTIONS = [
    "Which course should I choose?",
    "What courses do you offer?",
    "Courses for kids",
    "Where is the institute?",
    "What are the fees?"
  ];
  var ERRORS = {
    rate_limited: "You've sent a lot of messages in a short time. Please wait a few minutes — or ask our team directly on WhatsApp.",
    busy: "I'm getting a lot of questions right now. Please try again in a moment, or ask our team on WhatsApp.",
    fallback: "Sorry, I can't answer right now. Our team will be happy to help you on WhatsApp."
  };

  var ICONS = {
    close: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>',
    down: '<svg class="cb-close-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m6 9 6 6 6-6"/></svg>',
    reset: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M3 12a9 9 0 1 0 3-6.7L3 8"/><path d="M3 3v5h5"/></svg>',
    send: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>',
    wa: '<svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" focusable="false"><path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/></svg>'
  };

  var root = document.documentElement;
  var finePointer = window.matchMedia && window.matchMedia("(pointer: fine)").matches;

  /* ---------- Saved conversation (per browser tab) ---------- */
  function loadState() {
    try {
      var s = JSON.parse(window.sessionStorage.getItem(STORE_KEY));
      if (s && Array.isArray(s.msgs)) return s;
    } catch (e) { /* storage blocked */ }
    return { msgs: [], teaser: false };
  }
  function saveState() {
    try {
      window.sessionStorage.setItem(STORE_KEY, JSON.stringify({ msgs: state.msgs.slice(-30), teaser: state.teaser }));
    } catch (e) { /* storage blocked */ }
  }
  var state = loadState(); // msgs: [{ role: "user"|"assistant", content, error?, question? }]

  /* ---------- Safe text formatting for replies ---------- */
  function esc(s) {
    return String(s).replace(/[&<>"']/g, function (c) {
      return { "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c];
    });
  }
  // Only links to this site, WhatsApp, Google Maps, the student portal, phone or email.
  function safeHref(url) {
    url = String(url).trim();
    var own = url.match(/^https?:\/\/(?:www\.)?chedo\.in(\/[^\s]*)?$/i);
    if (own) return own[1] || "/";
    if (/^\/(?!\/)[\w\-./?=&#%]*$/.test(url)) return url;
    if (/^https:\/\/(wa\.me|api\.whatsapp\.com|chedo\.web\.app|maps\.google\.com|www\.google\.com\/maps|maps\.app\.goo\.gl)(\/|\?|$)/i.test(url)) return url;
    if (/^tel:\+?[\d\s-]{6,20}$/i.test(url) || /^mailto:[^\s"<>]+@[^\s"<>]+$/i.test(url)) return url;
    return null;
  }
  function linkLabel(href, label) {
    if (label !== href) return label;
    if (/wa\.me|whatsapp/i.test(href)) return "WhatsApp";
    if (/maps/i.test(href)) return "Google Maps";
    if (/chedo\.web\.app/i.test(href)) return "Student Portal";
    return label;
  }
  function anchor(href, label) {
    var external = /^https?:/i.test(href);
    return '<a href="' + esc(href) + '"' + (external ? ' target="_blank" rel="noopener"' : "") + ">" +
      esc(linkLabel(href, label)) + "</a>";
  }
  function inline(raw) {
    var re = /\[([^\]\n]{1,200})\]\(([^)\s]{1,500})\)|(https?:\/\/[^\s)<>\]]*[^\s)<>\].,!?;:'"])|\*\*([^*\n]+)\*\*/g;
    var out = "", last = 0, m, href;
    function text(s) { return esc(s.replace(/\*\*|`/g, "")); } // leftover markdown marks
    while ((m = re.exec(raw))) {
      out += text(raw.slice(last, m.index));
      if (m[1]) {
        href = safeHref(m[2]);
        out += href ? anchor(href, m[1]) : esc(m[1]);
      } else if (m[3]) {
        href = safeHref(m[3]);
        out += href ? anchor(href, m[3]) : esc(m[3]);
      } else {
        out += "<strong>" + esc(m[4]) + "</strong>";
      }
      last = re.lastIndex;
    }
    return out + text(raw.slice(last));
  }
  // Remove anything that isn't readable text: HTML tags, code fences, stray markdown.
  function clean(raw) {
    return String(raw)
      .replace(/<(script|style|iframe|object|embed|svg|math|template)\b[^>]*>[\s\S]*?<\/\1\s*>/gi, "")
      .replace(/<br\s*\/?>/gi, "\n")
      .replace(/<\/?[a-z][^>]*>/gi, "")
      .replace(/^```[a-z]*\s*$/gim, "")
      .replace(/\n{3,}/g, "\n\n")
      .trim();
  }
  function format(raw) {
    var html = "", list = null, para = [];
    raw = clean(raw);
    function flushPara() {
      if (para.length) html += "<p>" + para.map(inline).join("<br>") + "</p>";
      para = [];
    }
    function flushList() {
      if (list) html += "</" + list + ">";
      list = null;
    }
    String(raw).replace(/\r/g, "").split("\n").forEach(function (line) {
      var t = line.trim(), m;
      if (!t || /^\|?[\s:-]+\|[\s|:-]*$/.test(t)) { flushPara(); flushList(); return; }
      if ((m = t.match(/^[-*•]\s+(.*)$/)) || (m = t.match(/^\d+[.)]\s+(.*)$/))) {
        var type = /^\d/.test(t) ? "ol" : "ul";
        flushPara();
        if (list !== type) { flushList(); html += "<" + type + ">"; list = type; }
        html += "<li>" + inline(m[1]) + "</li>";
        return;
      }
      if ((m = t.match(/^#{1,6}\s+(.*)$/))) { flushPara(); flushList(); html += "<p><strong>" + esc(m[1]) + "</strong></p>"; return; }
      flushList();
      para.push(t.replace(/^\|\s*|\s*\|$/g, "").replace(/\s*\|\s*/g, " · "));
    });
    flushPara();
    flushList();
    return html;
  }

  function waLink(text) {
    return "https://wa.me/" + WA_NUMBER + "?text=" + encodeURIComponent(text);
  }

  /* ---------- Build the widget ---------- */
  var launcher, panel, log, form, input, sendBtn, teaser, teaserTimer;

  function el(tag, cls, html) {
    var n = document.createElement(tag);
    if (cls) n.className = cls;
    if (html) n.innerHTML = html;
    return n;
  }

  function build() {
    if (!document.getElementById("wa-fab")) root.classList.add("cb-solo");

    launcher = el("button", "cb-launcher",
      '<img src="' + LOGO + '" alt="" width="44" height="44" decoding="async">' +
      '<span class="cb-online" aria-hidden="true"></span>' + ICONS.down);
    launcher.type = "button";
    launcher.setAttribute("aria-label", "Chat with Chedo Assistant");
    launcher.setAttribute("aria-expanded", "false");
    launcher.setAttribute("aria-controls", "cb-panel");
    launcher.addEventListener("click", function () { panel.hidden ? openChat() : closeChat(); });

    panel = el("section", "cb-panel",
      '<div class="cb-head">' +
      '<span class="cb-head-avatar"><img src="' + LOGO + '" alt="" width="30" height="30"></span>' +
      '<div class="cb-head-text"><p class="cb-title" id="cb-title">Ask Chedo</p></div>' +
      '<button type="button" class="cb-head-btn" data-cb="reset" aria-label="Restart chat" title="Restart">' + ICONS.reset + '</button>' +
      '<button type="button" class="cb-head-btn" data-cb="close" aria-label="Close chat" title="Close">' + ICONS.close + "</button>" +
      "</div>" +
      '<div class="cb-accent-bar" aria-hidden="true"></div>' +
      '<div class="cb-log" role="log" aria-live="polite" aria-relevant="additions"></div>' +
      '<form class="cb-form" novalidate>' +
      '<label class="cb-sr" for="cb-input">Your question</label>' +
      '<textarea id="cb-input" class="cb-input" rows="1" maxlength="' + MAX_LEN + '" placeholder="Ask about courses, fees, timings…" autocomplete="off"></textarea>' +
      '<button type="submit" class="cb-send" aria-label="Send">' + ICONS.send + "</button>" +
      "</form>" +
      '<p class="cb-foot">Prefer a person? <a href="' + esc(waLink("Hello Chedo Tech, I would like to know more about your courses.")) +
      '" target="_blank" rel="noopener">Chat with our team on WhatsApp</a></p>');
    panel.id = "cb-panel";
    panel.hidden = true;
    panel.setAttribute("role", "dialog");
    panel.setAttribute("aria-labelledby", "cb-title");
    panel.tabIndex = -1;

    log = panel.querySelector(".cb-log");
    form = panel.querySelector(".cb-form");
    input = panel.querySelector(".cb-input");
    sendBtn = panel.querySelector(".cb-send");

    var closeBtn = panel.querySelector('[data-cb="close"]');
    if (closeBtn) closeBtn.addEventListener("click", closeChat);
    var resetBtn = panel.querySelector('[data-cb="reset"]');
    if (resetBtn) {
      resetBtn.addEventListener("click", function () {
        if (busy) return;
        state.msgs = [];
        saveState();
        renderAll();
        input.focus();
      });
    }
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      send(input.value);
    });
    input.addEventListener("keydown", function (e) {
      if (e.key === "Enter" && !e.shiftKey && !e.isComposing) {
        e.preventDefault();
        send(input.value);
      }
    });
    input.addEventListener("input", autosize);
    panel.addEventListener("keydown", function (e) {
      if (e.key === "Escape") closeChat();
    });

    document.body.appendChild(panel);
    document.body.appendChild(launcher);

    if (!state.teaser && !state.msgs.length) {
      teaserTimer = setTimeout(showTeaser, 7000);
    }
  }

  function showTeaser() {
    if (!panel.hidden || state.teaser) return;
    state.teaser = true;
    saveState();
    teaser = el("div", "cb-teaser", "👋 Hi! Have a question about our courses? Ask me here.");
    teaser.setAttribute("role", "button");
    teaser.tabIndex = 0;
    var x = el("button", "cb-teaser-close", "&times;");
    x.type = "button";
    x.setAttribute("aria-label", "Dismiss");
    x.addEventListener("click", function (e) {
      e.stopPropagation();
      hideTeaser();
    });
    teaser.appendChild(x);
    teaser.addEventListener("click", function (e) {
      e.stopPropagation();
      openChat();
    });
    teaser.addEventListener("keydown", function (e) {
      if (e.key === "Enter" || e.key === " ") { e.preventDefault(); openChat(); }
    });
    document.body.appendChild(teaser);
  }
  function hideTeaser() {
    clearTimeout(teaserTimer);
    if (teaser) teaser.remove();
    teaser = null;
  }

  function updateTopOffset() {
    var hdr = document.getElementById("site-header");
    if (hdr && panel) {
      var rect = hdr.getBoundingClientRect();
      panel.style.top = Math.max(0, Math.round(rect.bottom)) + "px";
    }
  }

  var rendered = false;
  function openChat() {
    hideTeaser();
    if (!rendered) renderAll();
    panel.hidden = false;
    updateTopOffset();
    root.classList.add("cb-open");
    launcher.setAttribute("aria-expanded", "true");
    launcher.setAttribute("aria-label", "Close chat");
    scrollDown();
    if (finePointer) input.focus();
    else panel.focus();
  }
  function closeChat() {
    panel.hidden = true;
    root.classList.remove("cb-open");
    launcher.setAttribute("aria-expanded", "false");
    launcher.setAttribute("aria-label", "Chat with Chedo Assistant");
    launcher.focus();
  }

  window.addEventListener("resize", function () {
    if (panel && !panel.hidden) updateTopOffset();
  });
  window.addEventListener("scroll", function () {
    if (panel && !panel.hidden) updateTopOffset();
  }, { passive: true });
  document.addEventListener("click", function (e) {
    if (panel && !panel.hidden && !panel.contains(e.target) && !launcher.contains(e.target)) {
      closeChat();
    }
  });

  /* ---------- Messages ---------- */
  function scrollDown() {
    log.scrollTop = log.scrollHeight;
    if (window.requestAnimationFrame) {
      window.requestAnimationFrame(function () {
        log.scrollTop = log.scrollHeight;
      });
    }
  }
  function addRow(role, html) {
    var row = el("div", "cb-row " + (role === "user" ? "cb-user" : "cb-bot"));
    if (role !== "user") {
      row.appendChild(el("span", "cb-avatar", '<img src="' + LOGO + '" alt="" width="32" height="32">'));
    }
    var bubble = el("div", "cb-bubble", html);
    row.appendChild(bubble);
    log.appendChild(row);
    scrollDown();
    return row;
  }
  function addMessage(m) {
    if (m.role === "user") return addRow("user", esc(m.content));
    var html = format(m.content);
    if (m.error) {
      html += '<a class="cb-wa-btn" href="' + esc(waLink("Hello Chedo Tech, " + (m.question || "I have a question about your courses."))) +
        '" target="_blank" rel="noopener">' + ICONS.wa + " Ask on WhatsApp</a>";
    }
    return addRow("assistant", html);
  }
  function addSuggestions() {
    var box = el("div", "cb-chips");
    SUGGESTIONS.forEach(function (q) {
      var b = el("button", "cb-chip");
      b.type = "button";
      b.textContent = q;
      b.addEventListener("click", function () { send(q); });
      box.appendChild(b);
    });
    log.appendChild(box);
  }
  function renderAll() {
    rendered = true;
    log.innerHTML = "";
    addRow("assistant", format(WELCOME));
    if (!state.msgs.length) addSuggestions();
    state.msgs.forEach(addMessage);
    scrollDown();
  }
  function autosize() {
    input.style.height = "auto";
    input.style.height = Math.min(input.scrollHeight, 104) + "px";
  }

  // The conversation sent to the server: answered turns only, newest last.
  function history() {
    var out = [];
    state.msgs.forEach(function (m, i) {
      var next = state.msgs[i + 1];
      if (m.error) return;
      if (m.role === "user" && next && next.error) return; // question that got no answer
      out.push({ role: m.role, content: m.content });
    });
    return out.slice(-8);
  }

  var busy = false;
  function setBusy(on) {
    busy = on;
    sendBtn.disabled = on;
    input.setAttribute("aria-busy", on ? "true" : "false");
  }

  function send(text) {
    text = String(text || "").trim().slice(0, MAX_LEN);
    if (!text || busy) return;
    var chips = log.querySelector(".cb-chips");
    if (chips) chips.remove();

    var userMsg = { role: "user", content: text };
    state.msgs.push(userMsg);
    saveState();
    addMessage(userMsg);
    input.value = "";
    autosize();
    setBusy(true);

    var typing = addRow("assistant", '<span class="cb-typing" aria-label="Chedo Assistant is typing"><span></span><span></span><span></span></span>');
    typing.querySelector(".cb-bubble").style.padding = "0";

    var ctrl = window.AbortController ? new AbortController() : null;
    var timer = setTimeout(function () { if (ctrl) ctrl.abort(); }, 60000);

    fetch(API_URL, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      credentials: "same-origin",
      body: JSON.stringify({ messages: history(), page: window.location.pathname }),
      signal: ctrl ? ctrl.signal : undefined
    })
      .then(function (res) {
        return res.json().catch(function () { return { ok: false, error: "upstream" }; });
      })
      .catch(function () {
        return { ok: false, error: "network" };
      })
      .then(function (data) {
        clearTimeout(timer);
        typing.remove();
        var reply = data && data.ok && data.reply
          ? { role: "assistant", content: String(data.reply) }
          : { role: "assistant", content: ERRORS[data && data.error] || ERRORS.fallback, error: true, question: text };
        state.msgs.push(reply);
        saveState();
        addMessage(reply);
        setBusy(false);
        if (finePointer) input.focus();
      });
  }

  /* ---------- Start: load the stylesheet, then show the button ---------- */
  function start() {
    var css = document.createElement("link");
    css.rel = "stylesheet";
    css.href = "/assets/css/chatbot.css" + (VERSION ? "?" + VERSION : "");
    css.onload = build;
    document.head.appendChild(css);
  }
  function scheduleStart() {
    if ("requestIdleCallback" in window) {
      window.requestIdleCallback(start, { timeout: 1500 });
    } else {
      setTimeout(start, 400);
    }
  }
  if (document.readyState === "complete") scheduleStart();
  else window.addEventListener("load", scheduleStart);
})();
