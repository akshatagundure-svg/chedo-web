const fs = require('fs');

// 1. UPDATE ASSETS/CSS/MAIN.CSS
let css = fs.readFileSync('assets/css/main.css', 'utf8');

const oldCssMarker = '/* ==========================================================================\n   Career Roadmap';
const oldCssMarkerCrlf = '/* ==========================================================================\r\n   Career Roadmap';

let cutIndex = css.indexOf(oldCssMarker);
if (cutIndex === -1) {
  cutIndex = css.indexOf(oldCssMarkerCrlf);
}

if (cutIndex !== -1) {
  css = css.substring(0, cutIndex);
}

const newRoadmapCss = `/* ==========================================================================
   Career Roadmap Sweeping Serpentine Curved Highway UI
   Recreating the wide curved road structure from the reference infographic
   ========================================================================== */
.roadmap-wrapper-card {
  position: relative;
  background: #fdfbf7;
  border: 1px solid #e2e8f0;
  border-radius: 28px;
  padding: 48px 40px 64px;
  box-shadow: 0 16px 36px -12px rgba(15, 23, 42, 0.05);
  overflow: hidden;
}

/* Halftone dot pattern in corner */
.roadmap-wrapper-card::after {
  content: "";
  position: absolute;
  bottom: 0;
  right: 0;
  width: 320px;
  height: 320px;
  background-image: radial-gradient(#d97706 1.5px, transparent 1.5px);
  background-size: 15px 15px;
  opacity: 0.10;
  pointer-events: none;
  mask-image: radial-gradient(circle at 100% 100%, black 20%, transparent 75%);
  -webkit-mask-image: radial-gradient(circle at 100% 100%, black 20%, transparent 75%);
}

.roadmap-header {
  text-align: center;
  margin-bottom: 50px;
  position: relative;
  z-index: 2;
}

.roadmap-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 4px 14px;
  border-radius: 9999px;
  background: #fef3c7;
  border: 1px solid #fde68a;
  color: #92400e;
  font-size: 11.5px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 12px;
}

.roadmap-title {
  font-size: 30px;
  font-weight: 800;
  color: #0f172a;
  letter-spacing: -0.02em;
  margin-bottom: 8px;
}

.roadmap-subtitle {
  font-size: 14.5px;
  color: #64748b;
  max-width: 640px;
  margin: 0 auto;
  line-height: 1.5;
}

.roadmap-flow-container {
  position: relative;
  width: 100%;
  z-index: 2;
  padding-top: 20px;
  padding-bottom: 30px;
}

.roadmap-highway-svg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: 1;
}

.roadmap-stages-wrapper {
  position: relative;
  z-index: 2;
  display: flex;
  flex-direction: column;
  gap: 60px;
}

/* Desktop Wide Curved Stages (>= 920px) */
@media (min-width: 920px) {
  .stage-row-curved {
    display: flex;
    flex-direction: column;
    position: relative;
    width: 100%;
  }
  .stage-row-curved.is-left {
    align-items: flex-start;
    padding-left: 6%;
  }
  .stage-row-curved.is-right {
    align-items: flex-end;
    padding-right: 6%;
  }
  .stage-card-block {
    max-width: 500px;
    width: 100%;
    margin-bottom: 16px;
  }
  .stage-pin-anchor {
    margin-left: 45px;
  }
  .stage-row-curved.is-right .stage-pin-anchor {
    margin-left: 0;
    margin-right: 45px;
  }
}

/* Pin Marker */
.stage-pin-anchor {
  position: relative;
  width: 60px;
  height: 74px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  filter: drop-shadow(0 8px 16px rgba(15, 23, 42, 0.38));
  transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
  cursor: pointer;
  z-index: 5;
}

.stage-pin-anchor:hover {
  transform: translateY(-5px) scale(1.08);
}

.stage-pin-svg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.stage-pin-number {
  position: relative;
  z-index: 2;
  margin-top: 13px;
  font-size: 16px;
  font-weight: 900;
  color: #0f172a;
  letter-spacing: -0.02em;
}

/* Stage Card Box */
.stage-card-block {
  background: #ffffff;
  border: 1.5px solid #e2e8f0;
  border-radius: 20px;
  padding: 22px 26px;
  box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.06);
  transition: all 0.25s ease;
  position: relative;
  z-index: 4;
  width: 100%;
}

.stage-card-block:hover {
  border-color: #60a5fa;
  box-shadow: 0 12px 30px -4px rgba(37, 99, 235, 0.16);
  transform: translateY(-2px);
}

.stage-header-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 8px;
  flex-wrap: wrap;
}

.stage-name-title {
  font-size: 17px;
  font-weight: 800;
  color: #0f172a;
  letter-spacing: -0.01em;
  line-height: 1.3;
}

.stage-duration-tag {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 3px 11px;
  border-radius: 9999px;
  font-size: 11.5px;
  font-weight: 700;
  background: #f1f5f9;
  color: #475569;
  border: 1px solid #e2e8f0;
  white-space: nowrap;
}

.stage-desc-text {
  font-size: 13.5px;
  color: #475569;
  line-height: 1.55;
  margin-bottom: 12px;
}

.stage-skills-wrap {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-bottom: 12px;
}

.stage-skill-pill {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 3px 9px;
  border-radius: 6px;
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  font-size: 11.5px;
  font-weight: 600;
  color: #334155;
}

.stage-milestone-box {
  padding: 10px 14px;
  border-radius: 12px;
  background: #eff6ff;
  border: 1px solid #dbeafe;
  font-size: 12px;
  color: #1e40af;
  line-height: 1.45;
  margin-bottom: 8px;
}

.stage-course-link {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 5px 13px;
  border-radius: 9999px;
  background: #2563eb;
  color: #ffffff;
  font-size: 11.5px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.2s;
}

.stage-course-link:hover {
  background: #1d4ed8;
  box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
}

.roadmap-goal-wrap {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  margin-top: 50px;
  position: relative;
  z-index: 3;
}

.roadmap-goal-icon {
  width: 66px;
  height: 66px;
  border-radius: 50%;
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 30px;
  box-shadow: 0 12px 28px rgba(16, 185, 129, 0.35);
  border: 4px solid #ffffff;
  margin-bottom: 12px;
}

.roadmap-goal-title {
  font-size: 15px;
  font-weight: 800;
  color: #065f46;
  background: #d1fae5;
  padding: 5px 22px;
  border-radius: 9999px;
  border: 1px solid #a7f3d0;
}

/* Mobile & Tablet Responsive (< 920px) */
@media (max-width: 919px) {
  .roadmap-wrapper-card {
    padding: 24px 16px 40px;
  }
  .stage-row-curved {
    display: flex !important;
    flex-direction: row;
    align-items: flex-start;
    gap: 16px;
  }
  .stage-pin-anchor {
    order: 1 !important;
    margin: 6px 0 0 0 !important;
    width: 44px;
    height: 54px;
  }
  .stage-pin-number {
    font-size: 13px;
    margin-top: 8px;
  }
  .stage-card-block {
    order: 2 !important;
    padding: 16px 18px;
    max-width: 100% !important;
    margin: 0 !important;
  }
  .stage-name-title {
    font-size: 15px;
  }
}
`;

css = css.trimEnd() + '\n\n' + newRoadmapCss;
fs.writeFileSync('assets/css/main.css', css, 'utf8');
console.log('assets/css/main.css updated!');

// 2. UPDATE ASSETS/JS/MAIN.JS
let js = fs.readFileSync('assets/js/main.js', 'utf8');

const oldJsMarker = '// 3. Visual Learning Roadmap';
let jsCutStart = js.indexOf(oldJsMarker);

const jsCutEndMarker = '// 4. Render Recommended Courses Cards';
const jsCutEnd = js.indexOf(jsCutEndMarker);

if (jsCutStart !== -1 && jsCutEnd !== -1) {
  const newJsBlock = `// 3. Visual Learning Roadmap (Sweeping Curved Highway UI)
        var roadmapBox = document.getElementById('roadmap-timeline');
        var roadmap = payload.roadmap || [];
        if (roadmapBox) {
          roadmapBox.innerHTML = '';
          roadmap.forEach(function(st, idx) {
            var isLeft = (idx % 2 === 0);
            var numStr = (st.stage_number < 10 ? '0' : '') + st.stage_number;
            var row = document.createElement('div');
            row.className = 'stage-row-curved ' + (isLeft ? 'is-left' : 'is-right');

            var skillsHtml = (st.skills || []).map(function(sk) {
              return "<span class='stage-skill-pill'><svg style='width:12px;height:12px;color:#10b981;' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2.5' d='M5 13l4 4L19 7'/></svg>" + sk + "</span>";
            }).join(' ');

            var courseBtn = '';
            if (st.chedo_course && st.chedo_course.title) {
              courseBtn = "<a href='" + (st.chedo_course.url || '#') + "' class='stage-course-link'><span>🎓 " + st.chedo_course.title + "</span> <span>&rarr;</span></a>";
            }

            var pinHtml = 
              "<div class='stage-pin-anchor' id='pin-anchor-" + idx + "' aria-label='Stage " + numStr + "'>" +
                "<svg class='stage-pin-svg' viewBox='0 0 54 66' fill='none' xmlns='http://www.w3.org/2000/svg'>" +
                  "<defs>" +
                    "<linearGradient id='pinGrad" + idx + "' x1='0%' y1='0%' x2='100%' y2='100%'>" +
                      "<stop offset='0%' stop-color='#fef08a' />" +
                      "<stop offset='50%' stop-color='#facc15' />" +
                      "<stop offset='100%' stop-color='#d97706' />" +
                    "</linearGradient>" +
                  "</defs>" +
                  "<path d='M27 65 C27 65 5 40 5 24 C5 11.85 14.85 2 27 2 C39.15 2 49 11.85 49 24 C49 40 27 65 27 65 Z' fill='url(#pinGrad" + idx + ")' stroke='#b45309' stroke-width='1.5' />" +
                  "<circle cx='27' cy='24' r='16' fill='#ffffff' stroke='#fde68a' stroke-width='1' />" +
                "</svg>" +
                "<span class='stage-pin-number'>" + numStr + "</span>" +
              "</div>";

            var cardHtml = 
              "<div class='stage-card-block'>" +
                "<div class='stage-header-row'>" +
                  "<h5 class='stage-name-title'>" + st.stage_name + "</h5>" +
                  "<span class='stage-duration-tag'>⏱ " + st.duration + "</span>" +
                "</div>" +
                "<p class='stage-desc-text'>" + st.description + "</p>" +
                "<div class='stage-skills-wrap'>" + skillsHtml + "</div>" +
                "<div class='stage-milestone-box'><strong>🎯 Practical Milestone:</strong> " + st.milestone + "</div>" +
                (courseBtn ? "<div style='margin-top: 10px;'>" + courseBtn + "</div>" : "") +
              "</div>";

            row.innerHTML = cardHtml + pinHtml;
            roadmapBox.appendChild(row);
          });

          // Function to dynamically draw the sweeping curved highway road
          function updateHighwayRibbon() {
            var container = document.getElementById('roadmap-flow-container');
            if (!container) return;
            var pins = container.querySelectorAll('.stage-pin-anchor');
            var goal = document.getElementById('roadmap-goal-wrap');
            if (!pins.length) return;

            var containerRect = container.getBoundingClientRect();
            if (containerRect.width === 0 || containerRect.height === 0) return;

            var points = [];
            pins.forEach(function(pin, i) {
              var pr = pin.getBoundingClientRect();
              var px = (pr.left + pr.width / 2) - containerRect.left;
              var py = (pr.top + pr.height - 3) - containerRect.top;
              points.push({ x: px, y: py, isLeft: (i % 2 === 0) });
            });

            if (goal) {
              var gr = goal.getBoundingClientRect();
              var gx = (gr.left + gr.width / 2) - containerRect.left;
              var gy = (gr.top + 32) - containerRect.top;
              points.push({ x: gx, y: gy, isGoal: true });
            }

            if (points.length < 2) return;

            var isDesktop = window.innerWidth >= 920;
            var first = points[0];

            var startX = isDesktop ? Math.max(10, first.x - 160) : first.x;
            var startY = first.y;

            var d = 'M ' + startX + ' ' + startY;
            d += ' L ' + first.x + ' ' + first.y;

            for (var i = 0; i < points.length - 1; i++) {
              var pA = points[i];
              var pB = points[i + 1];

              if (isDesktop) {
                // True S-Curve Serpentine Highway sweeping across canvas
                var deltaX = pB.x - pA.x;
                var deltaY = pB.y - pA.y;

                var cp1x = pA.x + deltaX * 0.55;
                var cp1y = pA.y + deltaY * 0.15;
                var cp2x = pB.x - deltaX * 0.45;
                var cp2y = pB.y - deltaY * 0.15;

                if (pB.isGoal) {
                  cp1x = pA.x + (pB.x - pA.x) * 0.2;
                  cp1y = pA.y + deltaY * 0.6;
                  cp2x = pB.x;
                  cp2y = pB.y - deltaY * 0.4;
                }

                d += ' C ' + cp1x + ' ' + cp1y + ', ' + cp2x + ' ' + cp2y + ', ' + pB.x + ' ' + pB.y;
              } else {
                var midY = (pA.y + pB.y) / 2;
                d += ' C ' + pA.x + ' ' + midY + ', ' + pB.x + ' ' + midY + ', ' + pB.x + ' ' + pB.y;
              }
            }

            ['road-path-shadow', 'road-path-curb', 'road-path-surface', 'road-path-dash'].forEach(function(id) {
              var el = document.getElementById(id);
              if (el) el.setAttribute('d', d);
            });
          }

          requestAnimationFrame(updateHighwayRibbon);
          setTimeout(updateHighwayRibbon, 80);
          setTimeout(updateHighwayRibbon, 350);

          if (!window._roadmapResizeBound) {
            window.addEventListener('resize', function() {
              requestAnimationFrame(updateHighwayRibbon);
            });
            window._roadmapResizeBound = true;
          }

          if (window.ResizeObserver) {
            var flowContainer = document.getElementById('roadmap-flow-container');
            if (flowContainer && !flowContainer._hasRO) {
              var ro = new ResizeObserver(function() {
                updateHighwayRibbon();
              });
              ro.observe(flowContainer);
              flowContainer._hasRO = true;
            }
          }
        }\n\n        `;

  js = js.substring(0, jsCutStart) + newJsBlock + js.substring(jsCutEnd);
  fs.writeFileSync('assets/js/main.js', js, 'utf8');
  console.log('assets/js/main.js updated!');
} else {
  console.error('Could not find JS markers:', { jsCutStart, jsCutEnd });
}
