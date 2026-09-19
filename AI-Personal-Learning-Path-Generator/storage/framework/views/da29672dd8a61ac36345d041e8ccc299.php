<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="AI Personal Learning Path Generator — a demo personal learning companion." />
  <title>Personal GPT — AI Learning Path Generator</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body class="mode-calm">
  <div class="app-shell">
    <aside class="sidebar" id="sidebar" aria-label="Personal analysis sidebar">
      <div class="brand-row">
        <div class="brand-mark">✦</div>
        <div>
          <strong>Personal GPT</strong>
          <span>Learning Companion</span>
        </div>
        <button class="icon-btn mobile-close" id="closeDrawer" aria-label="Close navigation">×</button>
      </div>

      <div class="profile-mini">
        <div class="avatar" id="avatarInitial">V</div>
        <div>
          <strong id="profileName">Viswa</strong>
          <span id="profileGoal">Full Stack Developer</span>
        </div>
      </div>

      <section class="side-section positive-section">
        <button class="section-title" type="button" data-scroll="positiveCards">
          <span><i class="dot positive"></i>Positive</span><span>⌄</span>
        </button>
        <div class="metric-list" id="positiveCards">
          <div class="metric"><span>Current Level</span><b data-metric="level">62%</b><div class="bar"><i style="--value:62%"></i></div></div>
          <div class="metric"><span>Behaviour</span><b data-metric="behaviour">76%</b><div class="bar"><i style="--value:76%"></i></div></div>
          <div class="metric"><span>Body Health</span><b data-metric="body">71%</b><div class="bar"><i style="--value:71%"></i></div></div>
          <div class="metric"><span>Emotional</span><b data-metric="emotional">68%</b><div class="bar"><i style="--value:68%"></i></div></div>
        </div>
      </section>

      <section class="side-section">
        <button class="section-title" type="button" data-scroll="taskCards">
          <span><i class="dot task"></i>Task</span><span>⌄</span>
        </button>
        <div class="task-metrics" id="taskCards">
          <div class="task-metric"><span>Task 1 Level</span><b>82%</b></div>
          <div class="task-metric"><span>Task 2 Level</span><b>46%</b></div>
          <div class="task-metric"><span>Task 3 Level</span><b>28%</b></div>
        </div>
      </section>

      <section class="side-section negative-section">
        <button class="section-title" type="button" data-scroll="negativeCards">
          <span><i class="dot negative"></i>Negative</span><span>⌄</span>
        </button>
        <div class="metric-list" id="negativeCards">
          <div class="metric"><span>Addiction Level</span><b>18%</b><div class="bar negative"><i style="--value:18%"></i></div></div>
          <div class="metric"><span>Negative Habits</span><b>24%</b><div class="bar negative"><i style="--value:24%"></i></div></div>
          <div class="metric"><span>Addiction</span><b>12%</b><div class="bar negative"><i style="--value:12%"></i></div></div>
        </div>
      </section>

      <section class="side-section customize-section">
        <button class="section-title" type="button" data-scroll="customizePanel">
          <span><i class="dot custom">✦</i>Customize</span><span>⌄</span>
        </button>
        <div class="customize-panel" id="customizePanel">
          <label>Theme
            <select id="themeSelect"><option value="dark">Dark</option><option value="light">Light</option></select>
          </label>
          <label>UI Mode
            <select id="modeSelect"><option value="calm">CALM</option><option value="energetic">ENERGETIC</option><option value="focus">FOCUS / SHARP</option><option value="relaxed">RELAXED</option></select>
          </label>
          <label class="switch-row">Animation <input id="animationToggle" type="checkbox" checked /><span class="switch"></span></label>
          <label>Explanation Length
            <input id="sideExplanation" type="range" min="0" max="2" step="1" value="1" />
          </label>
          <label>Check-in Frequency
            <select id="sideFrequency"><option value="2">Every 2 Days</option><option value="4">Every 4 Days</option><option value="7">Weekly</option></select>
          </label>
        </div>
      </section>

      <button class="side-chat-btn" id="jumpChat">◉ Chat</button>
    </aside>

    <main class="workspace">
      <header class="topbar">
        <div class="topbar-left">
          <button class="icon-btn menu-btn" id="menuBtn" aria-label="Open navigation">☰</button>
          <div>
            <span class="eyebrow">PERSONAL AI • LONG-TERM COMPANION</span>
            <h1>This AI understands you and creates your <em>personal learning path.</em></h1>
          </div>
        </div>
        <div class="time-card">
          <span id="dateNow">Friday, September 18</span>
          <strong id="timeNow">7:25 PM</strong>
        </div>
      </header>

      <section class="dashboard-grid">
        <section class="ai-card glass-card" id="aiArea">
          <div class="card-label"><span>ANIMATION AREA</span><span class="status-pill" id="aiStatus">IDLE</span></div>
          <div class="orb-stage" id="orbStage" aria-label="Animated AI analysis area">
            <div class="orbit orbit-a"></div><div class="orbit orbit-b"></div><div class="orbit orbit-c"></div>
            <div class="particle p1"></div><div class="particle p2"></div><div class="particle p3"></div><div class="particle p4"></div>
            <div class="ai-orb"><span>✦</span></div>
            <div class="waveform"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>
          </div>
          <div class="ai-state-copy">
            <strong id="aiStateTitle">Ready when you are.</strong>
            <span id="aiStateText">Your routine, goals and progress shape what comes next.</span>
          </div>
          <div class="analysis-actions">
            <button class="primary-btn" id="analyzeBtn">✦ Analyze my path</button>
            <button class="ghost-btn" id="onboardingBtn">Edit profile</button>
          </div>
        </section>

        <section class="output-card glass-card" id="outputInformation">
          <div class="card-label"><span>OUTPUT INFORMATION</span><span class="tiny-live">LIVE DEMO</span></div>
          <div class="output-main">
            <div class="output-icon">◎</div>
            <div><span>Current learning goal</span><strong id="goalOutput">Become a Full Stack Developer</strong></div>
          </div>
          <div class="output-grid">
            <div><span>Today's Focus</span><strong id="focusOutput">JavaScript DOM Events</strong></div>
            <div><span>Recommended Time</span><strong id="timeOutput">45 minutes</strong></div>
            <div><span>Current Progress</span><strong id="progressOutput">42%</strong></div>
            <div><span>Next Step</span><strong id="nextOutput">Build a small interactive form.</strong></div>
          </div>
          <div class="mini-progress"><i id="mainProgress" style="width:42%"></i></div>
        </section>

        <section class="showing-card glass-card" id="showingArea">
          <div class="showing-head">
            <div><span class="card-label">SHOWING</span><h2 id="showingTitle">Your personalized learning space</h2></div>
            <button class="refresh-btn" id="refreshmentBtn">☕ Refreshment</button>
          </div>
          <nav class="tabs" aria-label="Learning content tabs">
            <button class="tab active" data-tab="learning">Learning</button>
            <button class="tab" data-tab="tasks">Tasks</button>
            <button class="tab" data-tab="notes">Notes</button>
            <button class="tab" data-tab="progress">Progress</button>
            <button class="tab" data-tab="chat">AI Chat</button>
          </nav>
          <div class="tab-content" id="tabContent"></div>
        </section>

        <section class="lower-grid">
          <section class="path-card glass-card">
            <div class="card-label">MY PERSONAL LEARNING PATH</div>
            <div class="path-track" id="pathTrack">
              <button class="path-step active" data-step="0"><b>01</b><span>Foundation</span></button>
              <button class="path-step" data-step="1"><b>02</b><span>Core Concepts</span></button>
              <button class="path-step" data-step="2"><b>03</b><span>Guided Practice</span></button>
              <button class="path-step" data-step="3"><b>04</b><span>Mini Project</span></button>
              <button class="path-step" data-step="4"><b>05</b><span>Revision</span></button>
              <button class="path-step" data-step="5"><b>06</b><span>Assessment</span></button>
              <button class="path-step" data-step="6"><b>07</b><span>Next Level</span></button>
            </div>
            <p id="pathHint">Active step: Foundation. Complete a small DOM interaction to move forward.</p>
          </section>

          <section class="checkin-card glass-card">
            <div class="card-label">PERSONAL CHECK-IN</div>
            <div class="checkin-top"><div><span>Next Personal Check-in</span><strong id="checkinDate">Sep 20</strong></div><div class="countdown" id="countdown">2 days</div></div>
            <div class="frequency-row">
              <button data-frequency="2">Every 2 Days</button><button data-frequency="4">Every 4 Days</button><button data-frequency="7">Weekly</button>
            </div>
            <button class="secondary-btn full" id="checkinBtn">Start check-in</button>
          </section>
        </section>

        <section class="daily-card glass-card">
          <div class="daily-heading"><div><span class="card-label">TODAY'S TASK</span><h2>Learn: <em id="dailyTaskName">JavaScript DOM Basics</em></h2></div><span class="difficulty">Beginner</span></div>
          <div class="daily-meta"><span>⏱ <b>30 minutes</b></span><span>🎯 Focused practice</span><span>↗ Growth task included</span></div>
          <div class="daily-task-list">
            <label><input type="checkbox" class="daily-check" data-task="concept" checked /><span>Watch / learn concept</span></label>
            <label><input type="checkbox" class="daily-check" data-task="examples" /><span>Practice 3 examples</span></label>
            <label><input type="checkbox" class="daily-check" data-task="mini" /><span>Build mini interaction</span></label>
            <label><input type="checkbox" class="daily-check" data-task="break" /><span>Take a 10-minute break and return focused.</span></label>
          </div>
          <div class="daily-footer"><span id="taskProgressText">1 / 4 complete</span><div class="bar large"><i id="taskProgressBar" style="--value:25%"></i></div><button class="secondary-btn" id="completeTaskBtn">Complete today's task</button></div>
        </section>

        <section class="notes-card glass-card" id="notesFeature">
          <div class="notes-head"><div><span class="card-label">LARGE NOTES → SMALL TUTORING</span><h2>Turn long material into easy learning</h2></div><label class="upload-btn">＋ Upload Notes / PDF<input id="notesUpload" type="file" accept=".pdf,.txt,.md,.doc,.docx" hidden /></label></div>
          <div class="pipeline"><span>Large Notes / PDF</span><i>↓</i><span>Text Extraction</span><i>↓</i><span>AI Analysis</span><i>↓</i><span>Chunking</span><i>↓</i><span>Simplification</span><i>↓</i><span>Personalized Short Notes</span><i>↓</i><span>Questions + Answers</span></div>
          <div class="processing" id="processingBox" hidden>
            <div class="spinner"></div><strong id="processingText">Extracting text...</strong><span id="processingStep">1 / 4</span>
          </div>
          <div class="notes-result" id="notesResult">
            <div><span>SHORT EXPLANATION</span><p id="shortExplanation">The DOM is the browser's live tree of HTML elements. JavaScript can find those elements and react when a user clicks, types or submits something.</p></div>
            <div><span>KEY POINTS</span><ul id="keyPoints"><li>Select an element</li><li>Listen for an event</li><li>Change the page</li></ul></div>
            <div><span>EXAMPLE</span><pre id="codeExample">button.addEventListener('click', () => {
  message.textContent = 'Hello!';
});</pre></div>
            <div><span>QUICK QUESTIONS</span><p id="quickQuestions">What is an event? Why do we use addEventListener?</p></div>
            <div><span>NEXT LEARNING STEP</span><p id="nextLearningStep">Build a button that changes a card's text and progress.</p></div>
          </div>
          <div class="explanation-control"><div><span>EXPLANATION LENGTH</span><small>Short</small></div><input id="explanationSlider" type="range" min="0" max="2" step="1" value="1" aria-label="Explanation length" /><div class="slider-labels"><span>Short</span><span>Medium</span><span>Detailed</span></div></div>
        </section>
      </section>

      <section class="chat-bar" id="chatBar">
        <button class="plus-btn" id="chatPlus" aria-label="Open quick actions">＋</button>
        <textarea id="chatInput" rows="1" placeholder="Input texting area — ask: What should I learn today?" aria-label="Chat input"></textarea>
        <button class="send-btn" id="sendBtn" aria-label="Send message">↑</button>
        <div class="quick-actions" id="quickActions">
          <button data-prompt="What should I learn today?">Today's plan</button>
          <button data-prompt="Explain DOM events simply.">Explain simply</button>
          <button data-prompt="I am distracted. Give me a reset.">Quick reset</button>
        </div>
      </section>
    </main>
  </div>

  <div class="drawer-scrim" id="drawerScrim"></div>

  <div class="modal-backdrop" id="onboardingModal" hidden>
    <section class="onboarding-modal" role="dialog" aria-modal="true" aria-labelledby="onboardingTitle">
      <button class="icon-btn modal-close" id="closeOnboarding" aria-label="Close onboarding">×</button>
      <span class="eyebrow">PERSONAL ONBOARDING</span>
      <h2 id="onboardingTitle">Let's build a path around <em>you.</em></h2>
      <p>Personal questions are optional. This demo uses your answers to shape mock recommendations.</p>
      <form id="onboardingForm">
        <div class="form-grid">
          <label>Name <input name="name" value="Viswa" /></label>
          <label>What do you want to learn? <input name="goal" value="Full Stack Development" /></label>
          <label>Current level <select name="level"><option>Beginner</option><option>Intermediate</option><option>Advanced</option></select></label>
          <label>Main goal <input name="mainGoal" value="Build job-ready web projects" /></label>
          <label>Available hours/day <input name="hours" type="number" min="0.5" max="12" step="0.5" value="2" /></label>
          <label>Daily schedule <input name="schedule" value="Evening, 7–9 PM" /></label>
          <label>Study habits <input name="habits" value="Short focused practice" /></label>
          <label>Difficulties <input name="difficulties" placeholder="Optional" /></label>
          <label>Distractions <input name="distractions" value="Phone notifications" /></label>
          <label>Explanation style <select name="style"><option>Simple + examples</option><option>Step-by-step</option><option>Detailed</option></select></label>
          <label>Preferred UI mood <select name="mood"><option>Calm</option><option>Energetic</option><option>Focus / Sharp</option><option>Relaxed</option></select></label>
          <label>Personal context <input name="context" placeholder="Optional" /></label>
          <label>Recent happy/sad event <input name="events" placeholder="Optional" /></label>
          <label>Check-in frequency <select name="frequency"><option value="2">Every 2 Days</option><option value="4">Every 4 Days</option><option value="7">Weekly</option></select></label>
        </div>
        <div class="optional-note">✦ Optional personal information is used only to personalize this front-end demo.</div>
        <button class="primary-btn full" type="submit">Create my personal path →</button>
      </form>
    </section>
  </div>

  <div class="toast" id="toast" role="status"></div>
  <script src="script.js"></script>
</body>
</html><?php /**PATH /home/viswa/ai-learning-path-backend/resources/views/welcome.blade.php ENDPATH**/ ?>