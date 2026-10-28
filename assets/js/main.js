/* ============================================================
   Chedo Tech — main.js
   Lightweight interactions only. No frameworks, no dependencies.
   ============================================================ */
(function () {
  "use strict";

  /* Signal that JS is available (enables scroll-reveal styles) */
  document.documentElement.classList.add("js");

  var prefersReducedMotion =
    window.matchMedia &&
    window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ----------------------------------------------------------
     1. Sticky header state
     ---------------------------------------------------------- */
  var header = document.querySelector(".site-header");
  var onScroll = function () {
    if (!header) return;
    if (window.scrollY > 8) header.classList.add("is-scrolled");
    else header.classList.remove("is-scrolled");
  };
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  /* ----------------------------------------------------------
     2. Mobile navigation
     ---------------------------------------------------------- */
  var menuBtn = document.getElementById("menu-btn");
  var menuPanel = document.getElementById("mobile-menu");
  var menuClose = document.getElementById("menu-close");

  function setMenu(open) {
    if (!menuPanel || !menuBtn) return;
    menuPanel.classList.toggle("open", open);
    menuBtn.setAttribute("aria-expanded", open ? "true" : "false");
    menuBtn.setAttribute("aria-label", open ? "Close menu" : "Open menu");
    if (open && menuClose) menuClose.focus();
  }
  if (menuBtn) {
    menuBtn.addEventListener("click", function () {
      setMenu(!menuPanel.classList.contains("open"));
    });
  }
  /* Close the mobile menu after choosing a page, and when the screen grows to desktop */
  if (menuPanel) {
    menuPanel.addEventListener("click", function (e) {
      if (e.target.closest("a")) setMenu(false);
    });
  }
  window.addEventListener("resize", function () {
    if (window.innerWidth >= 1024) setMenu(false);
  });
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      setMenu(false);
      closeCourseDrop();
    }
  });

  /* Mobile "Courses" sub-menu */
  var mobCoursesBtn = document.getElementById("mob-courses-btn");
  var mobCoursesList = document.getElementById("mob-courses-list");
  if (mobCoursesBtn) {
    mobCoursesBtn.addEventListener("click", function () {
      var open = mobCoursesList.classList.toggle("hidden");
      mobCoursesBtn.setAttribute(
        "aria-expanded",
        mobCoursesList.classList.contains("hidden") ? "false" : "true"
      );
    });
  }

  /* Mobile "AI and DATA" sub-menu */
  var mobAiBtn = document.getElementById("mob-ai-btn");
  var mobAiList = document.getElementById("mob-ai-list");
  if (mobAiBtn) {
    mobAiBtn.addEventListener("click", function () {
      var open = mobAiList.classList.toggle("hidden");
      mobAiBtn.setAttribute(
        "aria-expanded",
        mobAiList.classList.contains("hidden") ? "false" : "true"
      );
    });
  }

  /* ----------------------------------------------------------
     3. Desktop Courses dropdown (click toggle for touch screens)
     ---------------------------------------------------------- */
  var dropBtn = document.getElementById("courses-drop-btn");
  var drop = document.getElementById("courses-drop");
  function closeCourseDrop() {
    if (drop) drop.classList.remove("drop-open");
    if (dropBtn) dropBtn.setAttribute("aria-expanded", "false");
  }
  if (dropBtn && drop) {
    dropBtn.addEventListener("click", function (e) {
      e.stopPropagation();
      var isOpen = drop.classList.toggle("drop-open");
      dropBtn.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });
    document.addEventListener("click", function (e) {
      if (!drop.contains(e.target)) closeCourseDrop();
    });
    drop.addEventListener("keydown", function (e) {
      if (e.key === "Escape") {
        closeCourseDrop();
        dropBtn.focus();
      }
    });
  }

  /* Desktop "AI and DATA" dropdown */
  var aiDropBtn = document.getElementById("ai-data-drop-btn");
  var aiDrop = document.getElementById("ai-data-drop");
  function closeAiDrop() {
    if (aiDrop) aiDrop.classList.remove("drop-open");
    if (aiDropBtn) aiDropBtn.setAttribute("aria-expanded", "false");
  }
  if (aiDropBtn && aiDrop) {
    aiDropBtn.addEventListener("click", function (e) {
      e.stopPropagation();
      var isOpen = aiDrop.classList.toggle("drop-open");
      aiDropBtn.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });
    document.addEventListener("click", function (e) {
      if (!aiDrop.contains(e.target)) closeAiDrop();
    });
    aiDrop.addEventListener("keydown", function (e) {
      if (e.key === "Escape") {
        closeAiDrop();
        aiDropBtn.focus();
      }
    });
  }

  /* ----------------------------------------------------------
     4. Course explorer filters
     ---------------------------------------------------------- */
  var filterBar = document.getElementById("course-filters");
  if (filterBar) {
    var cards = Array.prototype.slice.call(
      document.querySelectorAll("[data-category]")
    );
    filterBar.addEventListener("click", function (e) {
      var btn = e.target.closest("[data-filter]");
      if (!btn) return;
      var f = btn.getAttribute("data-filter");
      filterBar
        .querySelectorAll("[data-filter]")
        .forEach(function (b) {
          b.setAttribute("aria-pressed", b === btn ? "true" : "false");
        });
      cards.forEach(function (card) {
        var cats = (card.getAttribute("data-category") || "").split(" ");
        var show = f === "all" || cats.indexOf(f) !== -1;
        card.classList.toggle("course-card-hidden", !show);
      });
    });
  }

  /* ----------------------------------------------------------
     5. WhatsApp buttons (course-specific messages)
     ---------------------------------------------------------- */
  var CFG = window.SITE_CONFIG || {};
  var waNum = CFG.whatsapp || "";
  var waLinks = document.querySelectorAll("[data-wa]");
  function waHref(text) {
    return (
      "https://wa.me/" +
      waNum +
      "?text=" +
      encodeURIComponent(text || "Hello Chedo Tech, I would like to know more about your courses.")
    );
  }
  waLinks.forEach(function (el) {
    var msg = el.getAttribute("data-wa-text") || "";
    if (waNum) {
      el.setAttribute("href", waHref(msg));
      el.setAttribute("target", "_blank");
      el.setAttribute("rel", "noopener");
    }
    /* number not configured yet — the pre-generated href already
       points to the contact page with the correct relative path */
  });

  /* Floating WhatsApp button — only show when a number is configured */
  var fab = document.getElementById("wa-fab");
  if (fab && waNum) {
    fab.setAttribute("href", waHref());
    fab.setAttribute("target", "_blank");
    fab.setAttribute("rel", "noopener");
    fab.classList.remove("hidden");
    fab.classList.add("flex");
  } else if (fab) {
    fab.remove();
  }

  /* ----------------------------------------------------------
     6. Intelligent Career Assessment & Recommendation Engine
     ---------------------------------------------------------- */
  // Tech selection pills interactive toggle
  function initTechPills() {
    var techContainer = document.getElementById("tech-selector");
    if (!techContainer) return;

    var pills = techContainer.querySelectorAll(".tech-pill-btn, .tech-pill-label");
    var countBadge = document.getElementById("tech-selection-count");

    function updatePillVisual(label, isChecked) {
      if (!label) return;
      var cm = label.querySelector(".pill-check");
      var cp = label.querySelector(".pill-plus");

      if (isChecked) {
        label.classList.add("is-selected");
        label.setAttribute("aria-checked", "true");
        if (cm) cm.classList.remove("hidden");
        if (cp) cp.classList.add("hidden");
      } else {
        label.classList.remove("is-selected");
        label.setAttribute("aria-checked", "false");
        if (cm) cm.classList.add("hidden");
        if (cp) cp.classList.remove("hidden");
      }
    }

    function updateCount() {
      if (!countBadge) return;
      var checkedInputs = techContainer.querySelectorAll(".tech-checkbox:checked");
      var count = checkedInputs.length;
      if (count === 0) {
        countBadge.textContent = "0 Selected";
        countBadge.className = "text-[11px] font-semibold text-slate-500 bg-slate-100 px-3 py-1 rounded-full border border-slate-200 transition-all";
      } else {
        var isNoneChecked = Array.prototype.some.call(checkedInputs, function (cb) { return cb.value === "None"; });
        if (isNoneChecked) {
          countBadge.textContent = "None Selected";
          countBadge.className = "text-[11px] font-bold text-amber-700 bg-amber-50 px-3 py-1 rounded-full border border-amber-200 shadow-xs transition-all";
        } else {
          countBadge.textContent = count + " Selected";
          countBadge.className = "text-[11px] font-bold text-blue-700 bg-blue-50 px-3 py-1 rounded-full border border-blue-200 shadow-xs transition-all";
        }
      }
    }

    // Attach listeners to every pill
    pills.forEach(function (label) {
      var cb = label.querySelector(".tech-checkbox");
      if (!cb) return;

      // Ensure clicks on the pill NEVER propagate to outer elements or trigger link navigation
      label.addEventListener("click", function (e) {
        e.stopPropagation();
      });

      // Synchronize initial state
      updatePillVisual(label, cb.checked);
    });
    updateCount();

    // Use change event delegation for 100% reliable checkbox toggle
    techContainer.addEventListener("change", function (e) {
      e.stopPropagation();
      var targetCb = e.target;
      if (!targetCb || !targetCb.classList.contains("tech-checkbox")) return;

      var currentLabel = targetCb.closest(".tech-pill-btn, .tech-pill-label");
      var isNone = (targetCb.value === "None");

      if (targetCb.checked && isNone) {
        // "None" selected: deselect all individual technologies
        pills.forEach(function (otherLabel) {
          var otherCb = otherLabel.querySelector(".tech-checkbox");
          if (otherCb && otherCb !== targetCb) {
            otherCb.checked = false;
            updatePillVisual(otherLabel, false);
          }
        });
      } else if (targetCb.checked && !isNone) {
        // Specific tech selected: deselect "None"
        pills.forEach(function (noneLabel) {
          var noneCb = noneLabel.querySelector(".tech-checkbox");
          if (noneCb && noneCb.value === "None") {
            noneCb.checked = false;
            updatePillVisual(noneLabel, false);
          }
        });
      }

      if (currentLabel) {
        updatePillVisual(currentLabel, targetCb.checked);
      }
      updateCount();
    });

    // Keyboard support: Space or Enter key toggles
    techContainer.addEventListener("keydown", function (e) {
      if (e.key === "Enter" || e.key === " ") {
        var activeLabel = document.activeElement ? document.activeElement.closest(".tech-pill-btn, .tech-pill-label") : null;
        if (activeLabel) {
          var cb = activeLabel.querySelector(".tech-checkbox");
          if (cb) {
            e.preventDefault();
            e.stopPropagation();
            cb.checked = !cb.checked;
            cb.dispatchEvent(new Event("change", { bubbles: true }));
          }
        }
      }
    });
  }
  initTechPills();

  var contactForm = document.getElementById("enquiry-form");
  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      e.preventDefault();
      var btn = document.getElementById("btn-get-recommendation");
      var note = document.getElementById("form-note");

      // Basic validation check
      if (!contactForm.checkValidity()) {
        contactForm.reportValidity();
        return;
      }

      var fd = new FormData(contactForm);
      var data = {};
      var knownTechs = [];

      // Robust extraction of multi-select technologies
      if (typeof fd.getAll === "function") {
        knownTechs = fd.getAll("known_technologies[]").map(function (s) { return s.trim(); }).filter(Boolean);
      }

      fd.forEach(function (value, key) {
        if (key === "known_technologies[]") {
          if (!knownTechs.length) knownTechs.push(value.trim());
        } else {
          data[key] = value.trim();
        }
      });
      data.known_technologies = knownTechs;

      if (btn) {
        btn.disabled = true;
        btn.innerHTML = "<span>Analyzing Skills &amp; Generating Roadmap...</span> <span class='spinner ml-2'>⏳</span>";
      }
      if (note) note.classList.add("hidden");

      // Submit via REST API (/api/enquiries or fallback /api-recommend.php)
      fetch("/api/enquiries", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      })
        .then(function (res) {
          if (!res.ok) {
            return fetch("/api-recommend.php", {
              method: "POST",
              headers: { "Content-Type": "application/json" },
              body: JSON.stringify(data)
            }).then(function (fbRes) {
              if (!fbRes.ok) throw new Error("Server error");
              return fbRes.json();
            });
          }
          return res.json();
        })
        .then(function (result) {
          if (!result.success) throw new Error(result.message || "Invalid response");

          var payload = result.data || result;

          // Hide form, show results
          contactForm.classList.add("hidden");
          var resContainer = document.getElementById("recommendation-results");
          if (resContainer) {
            resContainer.classList.remove("hidden");
            resContainer.scrollIntoView({ behavior: "smooth", block: "start" });
          }

          // 1. Career Profile Header & Meta Badges
          var profile = payload.career_profile || {};
          var careerTitleEl = document.getElementById('res-career-title');
          if (careerTitleEl) {
            careerTitleEl.textContent = profile.recommended_career || data.career_goal || 'Recommended Career Path';
          }

          var metaContainer = document.getElementById('res-profile-meta');
          if (metaContainer) {
            metaContainer.innerHTML =
              "<div class='inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 shadow-xs'>" +
              "<span class='text-slate-400 font-medium'>Current Level:</span>" +
              "<span class='font-semibold text-slate-900'>" + (profile.learning_level || data.learning_level) + "</span>" +
              "</div>" +
              "<div class='inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-blue-50/70 border border-blue-100 text-xs text-blue-900 shadow-xs'>" +
              "<span class='text-blue-500 font-medium'>Daily Commitment:</span>" +
              "<span class='font-semibold text-blue-950'>" + (profile.daily_availability || data.daily_availability) + "</span>" +
              "</div>" +
              "<div class='inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-emerald-50/70 border border-emerald-100 text-xs text-emerald-900 shadow-xs'>" +
              "<span class='text-emerald-500 font-medium'>Target Timeline:</span>" +
              "<span class='font-semibold text-emerald-950'>" + (profile.estimated_duration || '5–6 Months') + "</span>" +
              "</div>" +
              "<div class='inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-purple-50/70 border border-purple-100 text-xs text-purple-900 shadow-xs'>" +
              "<span class='text-purple-500 font-medium'>Primary Objective:</span>" +
              "<span class='font-semibold text-purple-950'>" + (profile.learning_objective || data.learning_objective) + "</span>" +
              "</div>";
          }

          // 2. Skill-Gap Analysis
          var gap = payload.skill_gap_analysis || {};
          var akBox = document.getElementById('gap-already-known');
          if (akBox) {
            akBox.innerHTML = (gap.already_known && gap.already_known.length)
              ? gap.already_known.map(function (s) {
                return "<span class='inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200/80 shadow-xs'><span class='text-emerald-600 font-bold'>✓</span> " + s + "</span>";
              }).join(' ')
              : "<span class='text-xs text-slate-400 italic py-1'>None reported</span>";
          }

          var nrBox = document.getElementById('gap-needs-revision');
          if (nrBox) {
            nrBox.innerHTML = (gap.needs_revision && gap.needs_revision.length)
              ? gap.needs_revision.map(function (s) {
                return "<span class='inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-50 text-amber-900 border border-amber-200/80 shadow-xs'><span class='text-amber-600 font-bold'>↻</span> " + s + "</span>";
              }).join(' ')
              : "<span class='text-xs text-slate-400 italic py-1'>No revision required</span>";
          }

          var nlBox = document.getElementById('gap-needs-to-learn');
          if (nlBox) {
            nlBox.innerHTML = (gap.needs_to_learn && gap.needs_to_learn.length)
              ? gap.needs_to_learn.map(function (s) {
                return "<span class='inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-blue-50 text-blue-800 border border-blue-200/80 shadow-xs'><span class='text-blue-600 font-bold'>+</span> " + s + "</span>";
              }).join(' ')
              : "<span class='text-xs text-slate-400 italic py-1'>All core skills covered</span>";
          }

          // 3. Visual Learning Roadmap (Single-Screen S-Curve Highway UI)
          var roadmapBox = document.getElementById('roadmap-timeline');
          var roadmap = payload.roadmap || [];
          var activeModalStageIndex = 0;

          function cleanStageTitle(title) {
            if (!title) return '';
            var clean = title.replace(/^(STAGE\s*\d+\s*:\s*|FOUNDATION\s*:\s*|EXPANSION\s*:\s*|WEB\s*FUNDAMENTALS\s*:\s*|SPECIALIZATION\s*:\s*|JOB\s*READINESS\s*:\s*)/i, '').trim();
            clean = clean.replace(/Relational DBMS & SQL Mastery/i, 'Relational DBMS & SQL');
            clean = clean.replace(/Spring Boot, REST APIs & React/i, 'Spring Boot, REST & React');
            clean = clean.replace(/Projects, Resume & Mock Interviews/i, 'Projects & Placement Prep');
            return clean;
          }

          function formatCardMilestone(text) {
            if (!text) return '';
            var clean = text.trim();
            if (/banking application/i.test(clean)) return '60+ LeetCode & Banking App';
            if (/enterprise database schema/i.test(clean)) return 'Enterprise DB & stored procedures';
            if (/responsive frontend/i.test(clean)) return 'Responsive UI consuming REST APIs';
            if (/E-Commerce web application/i.test(clean)) return 'Full Stack E-Commerce (Spring Boot + React)';
            if (/3 full stack projects/i.test(clean)) return '3 Live URLs, ATS Resume & Mock Interviews';
            if (clean.length > 55) {
              var sub = clean.slice(0, 52);
              var sp = sub.lastIndexOf(' ');
              if (sp > 35) sub = sub.slice(0, sp);
              return sub + '...';
            }
            return clean;
          }

          function escapeHtml(str) {
            if (!str) return '';
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
          }

          function escapeAttr(str) {
            if (!str) return '';
            return String(str).replace(/"/g, '&quot;');
          }

          if (roadmapBox) {
            roadmapBox.innerHTML = '';
            roadmap.forEach(function (st, idx) {
              var isTop = (idx % 2 === 0);
              var numStr = (st.stage_number < 10 ? '0' : '') + st.stage_number;
              var col = document.createElement('div');
              col.className = 'stage-col ' + (isTop ? 'is-top' : 'is-bottom');
              col.setAttribute('data-stage-index', idx);

              var topSkills = (st.skills || []).slice(0, 3);
              var moreCount = (st.skills || []).length - topSkills.length;
              var skillsHtml = topSkills.map(function (sk) {
                return "<span class='stage-skill-pill'>" + escapeHtml(sk) + "</span>";
              }).join(' ');
              if (moreCount > 0) {
                skillsHtml += "<span class='stage-skill-more'>+" + moreCount + "</span>";
              }

              var courseBtn = '';
              if (st.chedo_course && st.chedo_course.title) {
                courseBtn = "<a href='" + (st.chedo_course.url || '#') + "' class='stage-course-btn' target='_blank' onclick='event.stopPropagation()'>🎓 Course &rarr;</a>";
              }

              var pinHtml =
                "<div class='stage-pin-anchor' id='pin-anchor-" + idx + "' aria-label='Stage " + numStr + "'>" +
                "<span class='stage-pin-pulse'></span>" +
                "<span class='stage-pin-number'>" + numStr + "</span>" +
                "</div>";

              var cardHtml =
                "<div class='stage-card-block' data-stage='" + idx + "' tabindex='0'>" +
                "<div class='stage-header-row'>" +
                "<span class='stage-pill-tag'>STAGE " + numStr + "</span>" +
                "<span class='stage-duration-tag'>⏱ " + escapeHtml(st.duration) + "</span>" +
                "</div>" +
                "<h5 class='stage-name-title' title='" + escapeAttr(st.stage_name) + "'>" + escapeHtml(cleanStageTitle(st.stage_name)) + "</h5>" +
                "<div class='stage-skills-wrap'>" + skillsHtml + "</div>" +
                "<div class='stage-milestone-box' title='" + escapeAttr(st.milestone) + "'>" +
                "<strong>🎯</strong> <span class='milestone-text'>" + escapeHtml(formatCardMilestone(st.milestone)) + "</span>" +
                "</div>" +
                "<div class='stage-card-footer'>" +
                courseBtn +
                "<button class='stage-details-btn' type='button' aria-label='View Stage " + numStr + " Details'>Details 🔍</button>" +
                "</div>" +
                "</div>";

              var stemHtml = "<div class='stage-connector-stem'></div>";
              var spacerHtml = "<div class='stage-spacer'></div>";

              if (isTop) {
                col.innerHTML = cardHtml + stemHtml + pinHtml + spacerHtml;
              } else {
                col.innerHTML = spacerHtml + pinHtml + stemHtml + cardHtml;
              }

              // Click events for card and pin
              var cardEl = col.querySelector('.stage-card-block');
              var pinEl = col.querySelector('.stage-pin-anchor');
              if (cardEl) {
                cardEl.addEventListener('click', function () {
                  openRoadmapModal(idx);
                });
              }
              if (pinEl) {
                pinEl.addEventListener('click', function (e) {
                  e.stopPropagation();
                  openRoadmapModal(idx);
                });
              }

              roadmapBox.appendChild(col);
            });

            // Ensure Goal Milestone is seamlessly positioned in Col 6
            var existingGoal = document.getElementById('roadmap-goal-wrap');
            if (existingGoal) {
              existingGoal.className = 'stage-col is-goal';
              existingGoal.innerHTML =
                "<div class='roadmap-goal-wrap'>" +
                "<div class='roadmap-goal-icon' aria-hidden='true'>🏆</div>" +
                "<div class='roadmap-goal-title'>Placement Ready</div>" +
                "<div class='roadmap-goal-subtitle'>Career Transition Complete</div>" +
                "</div>";
              roadmapBox.appendChild(existingGoal);
            }

            // Function to dynamically draw the smooth sinusoidal highway ribbon
            function updateHighwayRibbon() {
              var container = document.getElementById('roadmap-flow-container');
              if (!container) return;
              var pins = container.querySelectorAll('.stage-pin-anchor');
              var goal = document.getElementById('roadmap-goal-wrap');
              if (!pins.length) return;

              var containerRect = container.getBoundingClientRect();
              if (containerRect.width === 0 || containerRect.height === 0) return;

              var isDesktop = window.innerWidth >= 1024;
              var points = [];

              if (isDesktop) {
                var scaleX = 1400 / containerRect.width;
                var scaleY = 650 / containerRect.height;

                pins.forEach(function (pin, i) {
                  var pr = pin.getBoundingClientRect();
                  var px = ((pr.left + pr.width / 2) - containerRect.left) * scaleX;
                  var py = ((pr.top + pr.height / 2) - containerRect.top) * scaleY;
                  points.push({ x: px, y: py, isLeft: (i % 2 === 0) });
                });

                if (goal) {
                  var gr = goal.getBoundingClientRect();
                  var gx = ((gr.left + gr.width / 2) - containerRect.left) * scaleX;
                  var gy = ((gr.top + gr.height / 2) - containerRect.top) * scaleY;
                  points.push({ x: gx, y: gy, isGoal: true });
                }

                if (points.length < 2) return;

                // Continuous winding curve with deep vertical amplitudes:
                // Smooth lead-in curve leading to Peak 1 (High)
                var entryX = Math.max(15, points[0].x - (points[1].x - points[0].x) * 0.45);
                var entryY = (points[0].y + points[1].y) / 2;
                var d = 'M ' + entryX.toFixed(1) + ' ' + entryY.toFixed(1);

                var c1x = entryX + (points[0].x - entryX) * 0.5;
                var c2x = points[0].x - (points[0].x - entryX) * 0.4;
                d += ' C ' + c1x.toFixed(1) + ' ' + entryY.toFixed(1) + ', ' + c2x.toFixed(1) + ' ' + points[0].y.toFixed(1) + ', ' + points[0].x.toFixed(1) + ' ' + points[0].y.toFixed(1);

                // Peak 1 -> Valley 1 -> Peak 2 -> Valley 2 -> Peak 3 -> Final exit toward Placement Ready
                for (var i = 0; i < points.length - 1; i++) {
                  var pA = points[i];
                  var pB = points[i + 1];

                  var deltaX = pB.x - pA.x;

                  // Deep horizontal S-curve with pure horizontal tangents at crests & troughs
                  var cp1x = pA.x + deltaX * 0.5;
                  var cp1y = pA.y;
                  var cp2x = pB.x - deltaX * 0.5;
                  var cp2y = pB.y;

                  d += ' C ' + cp1x.toFixed(1) + ' ' + cp1y.toFixed(1) + ', ' + cp2x.toFixed(1) + ' ' + cp2y.toFixed(1) + ', ' + pB.x.toFixed(1) + ' ' + pB.y.toFixed(1);
                }
              } else {
                // Mobile / Tablet vertical highway starting at Stage 1
                pins.forEach(function (pin) {
                  var pr = pin.getBoundingClientRect();
                  var px = (pr.left + pr.width / 2) - containerRect.left;
                  var py = (pr.top + pr.height / 2) - containerRect.top;
                  points.push({ x: px, y: py });
                });

                if (goal) {
                  var mgr = goal.getBoundingClientRect();
                  var mgx = (mgr.left + 24) - containerRect.left;
                  var mgy = (mgr.top + mgr.height / 2) - containerRect.top;
                  points.push({ x: mgx, y: mgy, isGoal: true });
                }

                if (points.length < 2) return;

                var d = 'M ' + points[0].x.toFixed(1) + ' ' + points[0].y.toFixed(1);
                for (var j = 0; j < points.length - 1; j++) {
                  var p1 = points[j];
                  var p2 = points[j + 1];
                  var midY = (p1.y + p2.y) / 2;
                  d += ' C ' + p1.x.toFixed(1) + ' ' + midY.toFixed(1) + ', ' + p2.x.toFixed(1) + ' ' + midY.toFixed(1) + ', ' + p2.x.toFixed(1) + ' ' + p2.y.toFixed(1);
                }
              }

              ['road-path-surface', 'road-path-dash', 'road-path-shadow', 'road-path-curb'].forEach(function (id) {
                var el = document.getElementById(id);
                if (el) el.setAttribute('d', d);
              });
            }

            // Modal Handling Functions
            function openRoadmapModal(index) {
              var stage = roadmap[index];
              if (!stage) return;
              activeModalStageIndex = index;

              var numStr = (stage.stage_number < 10 ? '0' : '') + stage.stage_number;
              var modalTag = document.getElementById('stage-modal-tag');
              if (modalTag) modalTag.textContent = 'STAGE ' + numStr + ' OF ' + (roadmap.length < 10 ? '0' : '') + roadmap.length;

              var modalTitle = document.getElementById('stage-modal-title');
              if (modalTitle) modalTitle.textContent = stage.stage_name;

              var modalDuration = document.getElementById('stage-modal-duration');
              if (modalDuration) modalDuration.textContent = '⏱ Duration: ' + stage.duration;

              var modalDesc = document.getElementById('stage-modal-desc');
              if (modalDesc) modalDesc.textContent = stage.description;

              var modalMilestone = document.getElementById('stage-modal-milestone');
              if (modalMilestone) modalMilestone.innerHTML = '<strong>🎯 Milestone:</strong> ' + escapeHtml(stage.milestone);

              var reasonBox = document.getElementById('stage-modal-reason-box');
              var reasonText = document.getElementById('stage-modal-reason');
              if (reasonBox && reasonText) {
                if (stage.reason) {
                  reasonBox.style.display = 'block';
                  reasonText.textContent = stage.reason;
                } else {
                  reasonBox.style.display = 'none';
                }
              }

              var modalSkills = document.getElementById('stage-modal-skills');
              if (modalSkills) {
                modalSkills.innerHTML = (stage.skills || []).map(function (sk) {
                  return "<span class='stage-skill-pill'>✓ " + escapeHtml(sk) + "</span>";
                }).join(' ');
              }

              var actionBox = document.getElementById('stage-modal-action-box');
              if (actionBox) {
                if (stage.chedo_course && stage.chedo_course.title) {
                  actionBox.innerHTML = "<a href='" + (stage.chedo_course.url || '#') + "' class='stage-course-btn' target='_blank' style='padding: 6px 14px; font-size: 11.5px;'>🎓 Explore " + escapeHtml(stage.chedo_course.title) + " &rarr;</a>";
                } else {
                  actionBox.innerHTML = '';
                }
              }

              var prevBtn = document.getElementById('stage-modal-prev-btn');
              var nextBtn = document.getElementById('stage-modal-next-btn');
              if (prevBtn) prevBtn.disabled = (index === 0);
              if (nextBtn) nextBtn.disabled = (index === roadmap.length - 1);

              var modal = document.getElementById('roadmap-stage-modal');
              if (modal) {
                modal.classList.add('is-open');
                modal.setAttribute('aria-hidden', 'false');
              }
            }

            function closeRoadmapModal() {
              var modal = document.getElementById('roadmap-stage-modal');
              if (modal) {
                modal.classList.remove('is-open');
                modal.setAttribute('aria-hidden', 'true');
              }
            }

            var modalCloseBtn = document.getElementById('stage-modal-close-btn');
            if (modalCloseBtn && !modalCloseBtn._hasListener) {
              modalCloseBtn.addEventListener('click', closeRoadmapModal);
              modalCloseBtn._hasListener = true;
            }

            var modalBackdrop = document.getElementById('roadmap-stage-modal');
            if (modalBackdrop && !modalBackdrop._hasListener) {
              modalBackdrop.addEventListener('click', function (e) {
                if (e.target === this) closeRoadmapModal();
              });
              modalBackdrop._hasListener = true;
            }

            if (!window._modalKeyBound) {
              document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeRoadmapModal();
              });
              window._modalKeyBound = true;
            }

            var prevBtn = document.getElementById('stage-modal-prev-btn');
            if (prevBtn && !prevBtn._hasListener) {
              prevBtn.addEventListener('click', function () {
                if (activeModalStageIndex > 0) openRoadmapModal(activeModalStageIndex - 1);
              });
              prevBtn._hasListener = true;
            }

            var nextBtn = document.getElementById('stage-modal-next-btn');
            if (nextBtn && !nextBtn._hasListener) {
              nextBtn.addEventListener('click', function () {
                if (activeModalStageIndex < roadmap.length - 1) openRoadmapModal(activeModalStageIndex + 1);
              });
              nextBtn._hasListener = true;
            }

            requestAnimationFrame(updateHighwayRibbon);
            setTimeout(updateHighwayRibbon, 80);
            setTimeout(updateHighwayRibbon, 300);

            if (!window._roadmapResizeBound) {
              window.addEventListener('resize', function () {
                requestAnimationFrame(updateHighwayRibbon);
              });
              window._roadmapResizeBound = true;
            }

            if (window.ResizeObserver) {
              var flowContainer = document.getElementById('roadmap-flow-container');
              if (flowContainer && !flowContainer._hasRO) {
                var ro = new ResizeObserver(function () {
                  updateHighwayRibbon();
                });
                ro.observe(flowContainer);
                flowContainer._hasRO = true;
              }
            }
          }

          // 4. Render Recommended Courses Cards
          var cardsContainer = document.getElementById('recommendation-cards');
          var coursesList = payload.recommendations || [];
          if (cardsContainer) {
            cardsContainer.innerHTML = '';
            coursesList.forEach(function (c, i) {
              var isTop = (i === 0);
              var card = document.createElement('div');
              var baseClasses = 'relative recommendation-course-card p-6 sm:p-7 rounded-2xl bg-white transition-all duration-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6';

              card.className = isTop
                ? baseClasses + ' border-2 border-blue-500/30 shadow-[0_4px_20px_-4px_rgba(37,99,235,0.12)] ring-1 ring-blue-500/10 hover:shadow-[0_8px_30px_-4px_rgba(37,99,235,0.18)]'
                : baseClasses + ' border border-slate-200 shadow-sm hover:border-slate-300 hover:shadow-md';

              var topMatchBadge = isTop
                ? "<span class='inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200/80 shadow-xs'><svg class='h-3.5 w-3.5 text-blue-600 fill-blue-600' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path d='M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z'/></svg> Primary Recommendation</span>"
                : "<span class='inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-slate-50 text-slate-600 border border-slate-200/80'>Supporting Module</span>";

              var matchScoreBadge = "<span class='inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/70'><span class='h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse'></span>" + c.percentage + "% Match</span>";

              var actionBtn = isTop
                ? "<a href='" + c.url + "' class='shrink-0 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-xs sm:text-[13px] font-semibold text-white bg-blue-600 hover:bg-blue-700 active:scale-[0.98] transition-all shadow-sm hover:shadow-blue-500/20 whitespace-nowrap'>Explore Syllabus <svg class='w-4 h-4' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M5 12h14M12 5l7 7-7 7'/></svg></a>"
                : "<a href='" + c.url + "' class='shrink-0 inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-[13px] font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 active:scale-[0.98] transition-all border border-slate-200 whitespace-nowrap'>View Details <svg class='w-3.5 h-3.5 text-slate-500' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M5 12h14M12 5l7 7-7 7'/></svg></a>";

              card.innerHTML =
                "<div class='flex-1'>" +
                "<div class='flex flex-wrap items-center gap-2.5 mb-2.5'>" +
                "<h4 class='text-lg sm:text-[19px] font-bold text-slate-900 tracking-tight leading-snug'>" + c.name + "</h4>" +
                topMatchBadge +
                matchScoreBadge +
                "</div>" +
                "<p class='text-[13.5px] sm:text-sm text-slate-600 leading-relaxed max-w-2xl'>" + c.reason + "</p>" +
                "<div class='flex flex-wrap items-center gap-3 mt-3.5 text-xs text-slate-500'>" +
                "<span class='inline-flex items-center gap-1 font-medium text-slate-600'><svg class='w-3.5 h-3.5 text-blue-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'/></svg> Industry Projects</span>" +
                "<span class='text-slate-300'>•</span>" +
                "<span class='inline-flex items-center gap-1 font-medium text-slate-600'><svg class='w-3.5 h-3.5 text-blue-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'/></svg> Interview Practice</span>" +
                "<span class='text-slate-300'>•</span>" +
                "<span class='inline-flex items-center gap-1 font-medium text-slate-600'><svg class='w-3.5 h-3.5 text-blue-500' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'/></svg> 1-on-1 Mentorship</span>" +
                "</div>" +
                "</div>" +
                actionBtn;

              cardsContainer.appendChild(card);
            });
          }

          // 5. Daily Study Plan
          var studyPlan = payload.daily_study_plan || {};
          var spBadge = document.getElementById('study-plan-badge');
          if (spBadge) spBadge.textContent = studyPlan.total_hours || 'Recommended Schedule';

          var spItems = document.getElementById('study-plan-items');
          if (spItems && studyPlan.schedule) {
            spItems.innerHTML = studyPlan.schedule.map(function (item) {
              return "<div class='p-4 rounded-xl border border-slate-200/90 bg-slate-50/70 flex items-start gap-3.5 shadow-xs'>" +
                "<span class='px-2.5 py-1 rounded-lg bg-blue-100 text-blue-800 text-xs font-bold shrink-0'>" + item.time + "</span>" +
                "<div>" +
                "<div class='text-xs font-bold text-slate-900'>" + item.activity + "</div>" +
                "<div class='text-[11px] text-slate-500 mt-0.5 leading-relaxed'>" + item.focus + "</div>" +
                "</div>" +
                "</div>";
            }).join('');
          }
          var spAdvice = document.getElementById('study-plan-advice');
          if (spAdvice && studyPlan.advice) spAdvice.textContent = studyPlan.advice;

          // 6. Progressive Projects
          var projBox = document.getElementById('project-cards');
          var projects = payload.project_recommendations || [];
          if (projBox) {
            projBox.innerHTML = projects.map(function (p, pIdx) {
              var levelBadge = (pIdx === 0)
                ? "<span class='inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200/60 mb-2.5'>" + p.level + "</span>"
                : (pIdx === 1)
                  ? "<span class='inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-200/60 mb-2.5'>" + p.level + "</span>"
                  : "<span class='inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-purple-50 text-purple-700 border border-purple-200/60 mb-2.5'>" + p.level + "</span>";

              return "<div class='p-5 rounded-2xl border border-slate-200 bg-white shadow-xs hover:border-slate-300 hover:shadow-md transition-all duration-200 flex flex-col justify-between'>" +
                "<div>" +
                levelBadge +
                "<h5 class='text-sm font-bold text-slate-900 mb-1.5 leading-snug tracking-tight'>" + p.title + "</h5>" +
                "<p class='text-xs text-slate-600 leading-relaxed mb-4'>" + p.description + "</p>" +
                "</div>" +
                "<div class='pt-3 border-t border-slate-100 flex items-center gap-1 text-[11px] text-slate-500'>" +
                "<span class='font-medium text-slate-400'>Stack:</span> " +
                "<span class='font-semibold text-slate-700 truncate'>" + p.tech + "</span>" +
                "</div>" +
                "</div>";
            }).join('');
          }

          // 7. Job Readiness
          var jrBox = document.getElementById('job-readiness-content');
          var jrData = payload.job_readiness || {};
          if (jrBox) {
            jrBox.innerHTML = [
              jrData.dsa_practice ? "<div class='p-5 rounded-xl bg-white/5 border border-white/10'><div class='flex items-center gap-2 mb-3'><span class='h-2 w-2 rounded-full bg-blue-400'></span><h6 class='font-bold text-blue-300 text-xs tracking-wide uppercase'>" + jrData.dsa_practice.title + "</h6></div><ul class='space-y-2 text-slate-300'>" + jrData.dsa_practice.items.map(function (it) { return "<li class='flex items-start gap-1.5 leading-relaxed'><span class='text-blue-400 font-bold'>›</span><span>" + it + "</span></li>"; }).join('') + "</ul></div>" : '',
              jrData.technical_interview ? "<div class='p-5 rounded-xl bg-white/5 border border-white/10'><div class='flex items-center gap-2 mb-3'><span class='h-2 w-2 rounded-full bg-indigo-400'></span><h6 class='font-bold text-indigo-300 text-xs tracking-wide uppercase'>" + jrData.technical_interview.title + "</h6></div><ul class='space-y-2 text-slate-300'>" + jrData.technical_interview.items.map(function (it) { return "<li class='flex items-start gap-1.5 leading-relaxed'><span class='text-indigo-400 font-bold'>›</span><span>" + it + "</span></li>"; }).join('') + "</ul></div>" : '',
              jrData.placement_preparation ? "<div class='p-5 rounded-xl bg-white/5 border border-white/10'><div class='flex items-center gap-2 mb-3'><span class='h-2 w-2 rounded-full bg-emerald-400'></span><h6 class='font-bold text-emerald-300 text-xs tracking-wide uppercase'>" + jrData.placement_preparation.title + "</h6></div><ul class='space-y-2 text-slate-300'>" + jrData.placement_preparation.items.map(function (it) { return "<li class='flex items-start gap-1.5 leading-relaxed'><span class='text-emerald-400 font-bold'>›</span><span>" + it + "</span></li>"; }).join('') + "</ul></div>" : ''
            ].join('');
          }

          // 8. Update WhatsApp Consultation Button
          var waBtn = document.getElementById("btn-wa-recommendation");
          if (waBtn && waNum) {
            var recommendedNames = coursesList.map(function (c, i) { return (i + 1) + ". " + c.name + " (" + c.percentage + "% Match)"; });
            var waText =
              "Hello Chedo Tech,\n\n" +
              "I completed the Career Assessment on your website and would like mentor guidance.\n\n" +
              "Name: " + (data.name || "Student") + "\n" +
              "Education: " + (data.education || "Bachelor's") + "\n" +
              "Current Level: " + (data.learning_level || "Know Basic Programming") + "\n" +
              "Career Goal: " + (data.career_goal || "Java Full Stack Developer") + "\n" +
              "Known Technologies: " + (knownTechs.join(", ") || "None") + "\n" +
              "Primary Objective: " + (data.learning_objective || "Job and interview preparation") + "\n" +
              "Daily Availability: " + (data.daily_availability || "2–4 hours") + "\n\n" +
              "Recommended Career Path: " + (profile.recommended_career || data.career_goal) + "\n" +
              "Estimated Duration: " + (profile.estimated_duration || "5–6 Months") + "\n\n" +
              "Recommended Courses:\n" + recommendedNames.join("\n") + "\n\n" +
              "Please guide me regarding batch schedules and syllabus details.";

            waBtn.setAttribute("href", waHref(waText));
          }
        })
        .catch(function (err) {
          console.error("Recommendation submission error:", err);
          if (btn) {
            btn.disabled = false;
            btn.innerHTML = "<span>Generate My Career Roadmap</span> <svg aria-hidden='true' focusable='false' class='h-4 w-4 ml-2 inline' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M5 12h14'/><path d='m12 5 7 7-7 7'/></svg>";
          }
          if (note) {
            note.textContent = "Sorry, an error occurred while calculating your roadmap. Please check your connection or contact us directly on WhatsApp.";
            note.classList.remove("hidden");
          }
        });
    });
  }

  /* ----------------------------------------------------------
     7. Contact details from config
     ---------------------------------------------------------- */
  function setText(sel, val) {
    var el = document.querySelector(sel);
    if (el) el.textContent = val;
  }
  if (CFG) {
    if (CFG.phoneDisplay) {
      document.querySelectorAll("[data-phone]").forEach(function (el) { el.textContent = CFG.phoneDisplay; });
      var telLinks = document.querySelectorAll("[data-phone-link]");
      telLinks.forEach(function (a) {
        a.setAttribute("href", "tel:" + CFG.phoneTel);
      });
    } else {
      document.querySelectorAll("[data-phone]").forEach(function (el) {
        var parent = el.closest('li');
        if (parent) parent.style.display = 'none';
        else { var link = el.closest('a'); if (link) link.style.display = 'none'; }
      });
    }

    if (CFG.email) {
      document.querySelectorAll("[data-email]").forEach(function (el) { el.textContent = CFG.email; });
      document.querySelectorAll("[data-email-link]").forEach(function (a) {
        a.setAttribute("href", "mailto:" + CFG.email);
      });
    } else {
      document.querySelectorAll("[data-email]").forEach(function (el) {
        var parent = el.closest('li');
        if (parent) parent.style.display = 'none';
        else { var link = el.closest('a'); if (link) link.style.display = 'none'; }
      });
    }

    if (CFG.address) {
      document.querySelectorAll("[data-address]").forEach(function (el) { el.textContent = CFG.address; });
    } else {
      document.querySelectorAll("[data-address]").forEach(function (el) {
        var parent = el.closest('li');
        if (parent) parent.style.display = 'none';
        else { var link = el.closest('a'); if (link) link.style.display = 'none'; }
      });
    }

    if (CFG.mapsUrl) {
      document.querySelectorAll("[data-maps-link]").forEach(function (a) {
        a.setAttribute("href", CFG.mapsUrl);
        a.setAttribute("target", "_blank");
        a.setAttribute("rel", "noopener");
      });
    }
    if (CFG.mapsEmbed) {
      var mapFrame = document.getElementById("map-frame");
      /* only when different — re-setting the same src reloads the map */
      if (mapFrame && mapFrame.getAttribute("src") !== CFG.mapsEmbed) mapFrame.src = CFG.mapsEmbed;
    }
    /* current year in footer */
    var yearEl = document.getElementById("year");
    if (yearEl) yearEl.textContent = new Date().getFullYear();
  }

  /* ----------------------------------------------------------
     8. Reveal on scroll (disabled for reduced motion)
     ---------------------------------------------------------- */
  var revealEls = document.querySelectorAll(".reveal");
  if (revealEls.length && "IntersectionObserver" in window && !prefersReducedMotion) {
    var io = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (en) {
          if (en.isIntersecting) {
            en.target.classList.add("in");
            io.unobserve(en.target);
          }
        });
      },
      { threshold: 0.12, rootMargin: "0px 0px -40px 0px" }
    );
    revealEls.forEach(function (el) {
      io.observe(el);
    });
  } else {
    revealEls.forEach(function (el) {
      el.classList.add("in");
    });
  }
  /* ----------------------------------------------------------
     9. Global Clickable Cards
     ---------------------------------------------------------- */
  document.querySelectorAll(".card").forEach(function (card) {
    // Never hijack cards that contain forms, are inside forms, or are part of enquiry assessment
    if (card.querySelector("form") || card.closest("form") || card.closest("#enquireForm") || card.classList.contains("enquiry-form-card") || card.classList.contains("no-click-card")) {
      return;
    }

    var mainLink = card.querySelector("a[href]");
    if (mainLink) {
      card.style.cursor = "pointer";
      card.addEventListener("click", function (e) {
        if (window.getSelection().toString().length > 0) return;
        // Skip if click originated on any interactive element or form label
        if (e.target.closest("a, button, input, select, textarea, label, .tech-pill-btn, .tech-pill-label, #tech-selector")) return;

        var url = mainLink.getAttribute("href");
        if (!url || url === "#" || url.trim() === "" || url.startsWith("javascript:")) return;

        var target = mainLink.getAttribute("target");
        if (target === "_blank") {
          window.open(url, "_blank");
        } else {
          window.location.href = url;
        }
      });
    }
  });

})();
