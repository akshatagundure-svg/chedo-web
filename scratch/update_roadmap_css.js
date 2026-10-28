const fs = require('fs');

let css = fs.readFileSync('assets/css/main.css', 'utf8');

const marker = '/* ==========================================================================\n   Single-Screen S-Curve Career Roadmap Highway UI';
const markerCrlf = '/* ==========================================================================\r\n   Single-Screen S-Curve Career Roadmap Highway UI';

let idx = css.indexOf(marker);
if (idx === -1) {
  idx = css.indexOf(markerCrlf);
}

if (idx === -1) {
  console.error('Marker not found!');
  process.exit(1);
}

css = css.substring(0, idx);

const newRoadmapCss = `/* ==========================================================================
   Single-Screen S-Curve Career Roadmap Highway UI
   Compact winding highway fitting within a single desktop viewport (1366x768 & 1920x1080)
   ========================================================================== */
.roadmap-wrapper-card {
  position: relative;
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 24px;
  padding: 20px 24px 22px;
  box-shadow: 0 16px 36px -12px rgba(15, 23, 42, 0.06);
  overflow: hidden;
  box-sizing: border-box;
}

.roadmap-wrapper-card::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 5px;
  background: linear-gradient(90deg, #2563eb, #3b82f6, #f59e0b, #10b981);
}

/* Halftone dot pattern in corner */
.roadmap-wrapper-card::after {
  content: "";
  position: absolute;
  bottom: 0;
  right: 0;
  width: 260px;
  height: 260px;
  background-image: radial-gradient(#d97706 1.2px, transparent 1.2px);
  background-size: 14px 14px;
  opacity: 0.06;
  pointer-events: none;
  mask-image: radial-gradient(circle at 100% 100%, black 20%, transparent 75%);
  -webkit-mask-image: radial-gradient(circle at 100% 100%, black 20%, transparent 75%);
}

.roadmap-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 12px;
  position: relative;
  z-index: 2;
}

.roadmap-header-left {
  display: flex;
  flex-direction: column;
  gap: 3px;
}

.roadmap-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 3px 10px;
  border-radius: 9999px;
  background: #eff6ff;
  border: 1px solid #dbeafe;
  color: #1d4ed8;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  width: fit-content;
}

.roadmap-title {
  font-size: 18px;
  font-weight: 800;
  color: #0f172a;
  letter-spacing: -0.02em;
  margin: 0;
  line-height: 1.2;
}

.roadmap-subtitle {
  font-size: 12px;
  color: #64748b;
  margin: 0;
}

.roadmap-header-legend {
  display: flex;
  align-items: center;
  gap: 14px;
}

.legend-item {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: 11px;
  font-weight: 600;
  color: #64748b;
}

.legend-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
}

.legend-dot.start {
  background: #3b82f6;
}

.legend-dot.milestone {
  background: #f59e0b;
}

.legend-dot.goal {
  background: #10b981;
}

/* Container for SVG Highway & Alternating Stages */
.roadmap-flow-container {
  position: relative;
  width: 100%;
  height: clamp(430px, 50vh, 460px);
  z-index: 2;
}

.roadmap-highway-svg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: 1;
  overflow: visible;
}

/* 6-Column Alternating Grid */
.roadmap-stages-wrapper {
  position: relative;
  z-index: 3;
  width: 100%;
  height: 100%;
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 10px;
}

/* Single Stage Column */
.stage-col {
  position: relative;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-sizing: border-box;
}

.stage-col.is-top {
  justify-content: flex-start;
}

.stage-col.is-bottom {
  justify-content: flex-end;
}

.stage-col.is-goal {
  justify-content: center;
}

.stage-spacer {
  width: 100%;
  flex: 1 1 auto;
  pointer-events: none;
}

/* Connecting stem between Card and Pin */
.stage-connector-stem {
  width: 2px;
  height: 16px;
  background: repeating-linear-gradient(
    to bottom,
    #f59e0b,
    #f59e0b 3px,
    transparent 3px,
    transparent 6px
  );
  position: relative;
  z-index: 2;
  flex-shrink: 0;
}

.stage-connector-stem::after {
  content: "";
  position: absolute;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #d97706;
  left: -2px;
}

.stage-col.is-top .stage-connector-stem::after {
  top: 0;
}

.stage-col.is-bottom .stage-connector-stem::after {
  bottom: 0;
}

/* Yellow Numbered Milestone Pin */
.stage-pin-anchor {
  position: relative;
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: linear-gradient(135deg, #fef08a 0%, #facc15 50%, #d97706 100%);
  border: 3px solid #ffffff;
  box-shadow: 0 8px 16px -2px rgba(15, 23, 42, 0.42), 0 0 0 1px #b45309;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  z-index: 5;
  flex-shrink: 0;
  transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease;
}

.stage-pin-anchor:hover,
.stage-col:hover .stage-pin-anchor {
  transform: scale(1.15) translateY(-2px);
  box-shadow: 0 12px 24px -2px rgba(217, 119, 6, 0.5), 0 0 0 2px #d97706;
}

.stage-pin-number {
  font-size: 13.5px;
  font-weight: 900;
  color: #0f172a;
  letter-spacing: -0.02em;
  line-height: 1;
}

.stage-pin-pulse {
  position: absolute;
  top: -4px;
  left: -4px;
  right: -4px;
  bottom: -4px;
  border-radius: 50%;
  border: 2px solid #facc15;
  opacity: 0;
  animation: pinPulse 2.4s infinite ease-out;
  pointer-events: none;
}

@keyframes pinPulse {
  0% {
    transform: scale(0.95);
    opacity: 0.8;
  }
  100% {
    transform: scale(1.35);
    opacity: 0;
  }
}

/* Compact & Neat Stage Card */
.stage-card-block {
  width: 100%;
  max-width: 215px;
  background: #ffffff;
  border: 1.5px solid #e2e8f0;
  border-radius: 12px;
  padding: 9px 11px;
  box-shadow: 0 4px 12px -3px rgba(15, 23, 42, 0.07);
  transition: all 0.22s ease;
  position: relative;
  z-index: 4;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  box-sizing: border-box;
  flex-shrink: 0;
}

.stage-card-block:hover {
  border-color: #2563eb;
  box-shadow: 0 8px 20px -3px rgba(37, 99, 235, 0.16);
  transform: translateY(-2px);
}

.stage-header-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 6px;
  margin-bottom: 5px;
}

.stage-pill-tag {
  font-size: 9px;
  font-weight: 800;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  color: #2563eb;
  background: #eff6ff;
  border: 1px solid #dbeafe;
  padding: 1.5px 5px;
  border-radius: 4px;
}

.stage-duration-tag {
  display: inline-flex;
  align-items: center;
  gap: 3px;
  font-size: 9.5px;
  font-weight: 700;
  background: #f1f5f9;
  color: #475569;
  padding: 1px 6px;
  border-radius: 9999px;
  border: 1px solid #e2e8f0;
  white-space: nowrap;
}

.stage-name-title {
  font-size: 12px;
  font-weight: 800;
  color: #0f172a;
  letter-spacing: -0.01em;
  line-height: 1.25;
  margin-bottom: 5px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.stage-skills-wrap {
  display: flex;
  flex-wrap: wrap;
  gap: 3px;
  margin-bottom: 5px;
  max-height: 22px;
  overflow: hidden;
}

.stage-skill-pill {
  display: inline-flex;
  align-items: center;
  padding: 1px 5px;
  border-radius: 4px;
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  font-size: 9.5px;
  font-weight: 600;
  color: #334155;
  white-space: nowrap;
}

.stage-skill-more {
  font-size: 9px;
  font-weight: 700;
  color: #2563eb;
  background: #eff6ff;
  padding: 1px 4.5px;
  border-radius: 4px;
}

.stage-milestone-box {
  padding: 3.5px 6px;
  border-radius: 6px;
  background: #f0fdf4;
  border: 1px solid #bbf7d0;
  font-size: 9.5px;
  color: #15803d;
  line-height: 1.3;
  margin-bottom: 5px;
  display: flex;
  align-items: flex-start;
  gap: 3px;
}

.stage-milestone-box strong {
  color: #166534;
  white-space: nowrap;
}

.milestone-text {
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}

.stage-card-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 4px;
  margin-top: auto;
  padding-top: 4px;
  border-top: 1px solid #f1f5f9;
}

.stage-course-btn {
  display: inline-flex;
  align-items: center;
  gap: 3px;
  padding: 2.5px 7px;
  border-radius: 5px;
  background: #2563eb;
  color: #ffffff;
  font-size: 9.5px;
  font-weight: 700;
  text-decoration: none;
  transition: background 0.15s ease;
  white-space: nowrap;
}

.stage-course-btn:hover {
  background: #1d4ed8;
}

.stage-details-btn {
  background: none;
  border: none;
  color: #2563eb;
  font-size: 9.5px;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 2px;
  padding: 2px 5px;
  border-radius: 4px;
  transition: all 0.15s ease;
}

.stage-details-btn:hover {
  background: #eff6ff;
  color: #1d4ed8;
}

/* Goal Milestone (Column 6) */
.roadmap-goal-wrap {
  width: 100%;
  max-width: 140px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  position: relative;
  z-index: 4;
}

.roadmap-goal-icon {
  width: 46px;
  height: 46px;
  border-radius: 50%;
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 22px;
  box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
  border: 3px solid #ffffff;
  margin-bottom: 8px;
}

.roadmap-goal-title {
  font-size: 12.5px;
  font-weight: 800;
  color: #065f46;
  background: #ecfdf5;
  padding: 4px 12px;
  border-radius: 9999px;
  border: 1px solid #a7f3d0;
  white-space: nowrap;
}

.roadmap-goal-subtitle {
  font-size: 10px;
  color: #059669;
  font-weight: 600;
  margin-top: 4px;
  line-height: 1.25;
}

/* ==========================================================================
   Interactive Stage Details Modal
   ========================================================================== */
.stage-modal-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(15, 23, 42, 0.6);
  backdrop-filter: blur(4px);
  -webkit-backdrop-filter: blur(4px);
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 99999;
  padding: 20px;
  box-sizing: border-box;
}

.stage-modal-backdrop.is-open {
  display: flex;
  animation: modalFadeIn 0.2s ease-out forwards;
}

@keyframes modalFadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.stage-modal-card {
  background: #ffffff;
  border-radius: 20px;
  box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25);
  width: 100%;
  max-width: 580px;
  max-height: 90vh;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  border: 1px solid #e2e8f0;
  animation: modalScaleUp 0.22s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes modalScaleUp {
  from { transform: scale(0.96) translateY(8px); }
  to { transform: scale(1) translateY(0); }
}

.stage-modal-header {
  padding: 20px 24px 16px;
  border-bottom: 1px solid #f1f5f9;
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  background: #f8fafc;
}

.stage-modal-close {
  background: none;
  border: none;
  font-size: 22px;
  color: #94a3b8;
  cursor: pointer;
  line-height: 1;
  padding: 4px 8px;
  border-radius: 6px;
  transition: all 0.15s ease;
}

.stage-modal-close:hover {
  background: #e2e8f0;
  color: #0f172a;
}

.stage-modal-tag {
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  color: #2563eb;
  margin-bottom: 4px;
}

.stage-modal-title {
  font-size: 18px;
  font-weight: 800;
  color: #0f172a;
  letter-spacing: -0.01em;
  line-height: 1.3;
}

.stage-modal-meta {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 8px;
}

.stage-modal-body {
  padding: 20px 24px;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.modal-section-title {
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  color: #64748b;
  margin-bottom: 6px;
}

.stage-modal-desc {
  font-size: 13.5px;
  color: #334155;
  line-height: 1.55;
}

.stage-modal-skills {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
}

.stage-modal-skills .stage-skill-pill {
  font-size: 11.5px;
  padding: 3px 9px;
  background: #eff6ff;
  border-color: #bfdbfe;
  color: #1e40af;
  font-weight: 600;
}

.stage-modal-milestone {
  background: #eff6ff;
  border: 1.5px solid #bfdbfe;
  border-radius: 12px;
  padding: 12px 14px;
  font-size: 12.5px;
  color: #1e40af;
  line-height: 1.5;
}

.stage-modal-milestone strong {
  color: #1e3a8a;
  display: block;
  margin-bottom: 3px;
}

.stage-modal-reason {
  background: #fdfbf7;
  border: 1px solid #fde68a;
  border-radius: 12px;
  padding: 12px 14px;
  font-size: 12.5px;
  color: #92400e;
  line-height: 1.5;
}

.stage-modal-footer {
  padding: 14px 24px;
  background: #f8fafc;
  border-top: 1px solid #f1f5f9;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}

.stage-nav-btn {
  padding: 6px 12px;
  border-radius: 8px;
  background: #ffffff;
  border: 1px solid #cbd5e1;
  color: #334155;
  font-size: 11.5px;
  font-weight: 600;
  cursor: pointer;
}

.stage-nav-btn:hover:not(:disabled) {
  background: #f1f5f9;
  border-color: #94a3b8;
}

.stage-nav-btn:disabled {
  opacity: 0.4;
  cursor: not-allowed;
}

/* Small Viewport Height Density Tuning (e.g. 1366x768 screens) */
@media (min-width: 1024px) and (max-height: 780px) {
  .roadmap-wrapper-card {
    padding: 16px 20px 18px;
  }
  .roadmap-header {
    margin-bottom: 8px;
  }
  .roadmap-flow-container {
    height: 420px;
  }
  .stage-card-block {
    padding: 7px 10px;
  }
  .stage-milestone-box {
    margin-bottom: 4px;
    padding: 3px 5px;
  }
}

/* Tablet & Mobile Responsiveness (< 1024px) */
@media (max-width: 1023px) {
  .roadmap-wrapper-card {
    padding: 24px 16px 36px;
  }
  .roadmap-flow-container {
    height: auto;
  }
  .roadmap-stages-wrapper {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  .stage-col {
    flex-direction: row;
    align-items: flex-start;
    gap: 14px;
    width: 100%;
  }
  .stage-col.is-top,
  .stage-col.is-bottom {
    justify-content: flex-start;
  }
  .stage-spacer,
  .stage-connector-stem {
    display: none !important;
  }
  .stage-pin-anchor {
    order: 1 !important;
    margin-top: 4px;
    width: 44px;
    height: 44px;
  }
  .stage-card-block {
    order: 2 !important;
    max-width: 100%;
    height: auto;
  }
  .stage-col.is-goal {
    order: 99;
  }
  .roadmap-goal-wrap {
    max-width: 100%;
    flex-direction: row;
    gap: 14px;
    text-align: left;
    margin-top: 10px;
  }
}
`;

css = css.trimEnd() + '\n\n' + newRoadmapCss;
fs.writeFileSync('assets/css/main.css', css, 'utf8');
console.log('Successfully updated assets/css/main.css!');
