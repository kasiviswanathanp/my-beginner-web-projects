const appState = {
  profile:{name:'Viswa',goal:'Full Stack Developer',level:'Beginner',hours:2,schedule:'Evening, 7–9 PM',habits:'Short focused practice'},
  progress:42,
  frequency:2,
  explanation:1,
  mode:'calm',
  theme:'dark',
  animation:true,
  pathStep:0,
  tab:'learning',
  messages:[]
};

const $ = s => document.querySelector(s);
const $$ = s => [...document.querySelectorAll(s)];

const explanationData = [
  {label:'Short', text:'The DOM is the browser’s live tree of HTML elements. JavaScript can find an element and react when a user clicks or types.', points:['Find an element','Listen for an event','Change the page'], example:"button.addEventListener('click', () => {\n  message.textContent = 'Hello!';\n});", questions:'What is an event? Why do we use addEventListener?', next:'Build a button that changes a card’s text.'},
  {label:'Medium', text:'The DOM (Document Object Model) turns your HTML page into objects JavaScript can work with. Events such as click, input and submit let your code respond to the user. For example, a button can listen for a click and update a message without reloading the page.', points:['DOM = page structure as objects','Events describe user actions','addEventListener connects an action to code'], example:"const button = document.querySelector('button');\nbutton.addEventListener('click', () => {\n  message.textContent = 'Hello!';\n});", questions:'What does querySelector return? What happens when the button is clicked?', next:'Build a small interactive form using click and input events.'},
  {label:'Detailed', text:'Think of the DOM as a live map of your HTML document. Each heading, button, input and card becomes an object that JavaScript can select, read and change. An event is a signal that something happened — for example, a click, key press, input change or form submission. addEventListener lets you attach a function to that signal. This creates the core loop of interactive web pages: select → listen → respond → update.', points:['querySelector selects an element from the DOM','addEventListener registers a response function','The event object can contain useful details','Changing text/classes/attributes updates the visible page'], example:"const form = document.querySelector('#signup');\nform.addEventListener('submit', (event) => {\n  event.preventDefault();\n  message.textContent = 'Form received!';\n});", questions:'How is an event different from an element? Why can preventDefault() be useful on forms?', next:'Build and validate a mini form, then show a personalized success message.'}
];

function toast(message){const el=$('#toast');el.textContent=message;el.classList.add('show');clearTimeout(window.toastTimer);window.toastTimer=setTimeout(()=>el.classList.remove('show'),2500)}
function escapeHTML(s){return String(s).replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[m]))}

function updateClock(){
  const now=new Date();
  $('#dateNow').textContent=new Intl.DateTimeFormat('en-IN',{weekday:'long',month:'long',day:'numeric'}).format(now);
  $('#timeNow').textContent=new Intl.DateTimeFormat('en-IN',{hour:'numeric',minute:'2-digit',hour12:true}).format(now);
}
updateClock();setInterval(updateClock,1000);

function animateBars(){
  requestAnimationFrame(()=>$$('.bar i').forEach((bar,i)=>{const v=bar.style.getPropertyValue('--value');bar.style.width='0';setTimeout(()=>bar.style.width=v,i*100+100)}));
  const progress=$('#mainProgress');progress.style.width='0';setTimeout(()=>progress.style.width=appState.progress+'%',150);
}

function setAIState(state){
  const card=$('#aiArea'), pill=$('#aiStatus'), title=$('#aiStateTitle'), text=$('#aiStateText');
  card.classList.remove('thinking','analyzing','responding');
  const data={idle:['IDLE','Ready when you are.','Your routine, goals and progress shape what comes next.'],thinking:['THINKING','Connecting your goals…','Looking at today’s focus and your available time.'],analyzing:['ANALYZING','Building your path…','Balancing learning, practice, consistency and recovery.'],responding:['RESPONDING','Your next step is ready.','A personalized demo recommendation has been prepared.']};
  pill.textContent=data[state][0];title.textContent=data[state][1];text.textContent=data[state][2];if(state!=='idle')card.classList.add(state);
}

function analyzePath(){
  setAIState('thinking');
  setTimeout(()=>setAIState('analyzing'),700);
  setTimeout(()=>{setAIState('responding');appState.progress=Math.min(100,appState.progress+2);$('#progressOutput').textContent=appState.progress+'%';animateBars();setPathStep(Math.min(1,appState.pathStep+1));toast('Personal analysis updated — demo progress +2%');},1700);
  setTimeout(()=>setAIState('idle'),3400);
}

function renderTab(tab=appState.tab){
  appState.tab=tab; $$('.tab').forEach(b=>b.classList.toggle('active',b.dataset.tab===tab));
  const box=$('#tabContent');
  if(tab==='learning') box.innerHTML=`<div class="learning-layout"><div class="content-box"><h3>JavaScript DOM Events</h3><p>Start with one simple idea: <b>when something happens, your code can react.</b> Today, connect a button click to a visible change.</p><div class="chips"><span class="chip">Concept</span><span class="chip">Example</span><span class="chip">Practice</span><span class="chip">30 min</span></div></div><div class="content-box"><h3>AI recommendation</h3><p>Keep the first interaction tiny. Build it, test it, then add one new event.</p><button class="secondary-btn full" onclick="setPathStep(2)">Move to Guided Practice →</button></div></div>`;
  if(tab==='tasks') box.innerHTML=`<div class="content-box"><h3>Beginner task board</h3><p>✓ Learn DOM basics</p><p>□ Practice 3 event examples</p><p>□ Build a mini interaction</p><p>□ Take a 10-minute reset</p><button class="primary-btn" onclick="completeAllTasks()">Mark task set complete</button></div>`;
  if(tab==='notes') box.innerHTML=`<div class="content-box"><h3>Personalized notes</h3><p>Long notes → extracted concepts → simple explanations → questions.</p><button class="secondary-btn" onclick="$('#notesFeature').scrollIntoView({behavior:'smooth'})">Open Notes / PDF feature ↓</button></div>`;
  if(tab==='progress') box.innerHTML=`<div class="content-box"><h3>Progress snapshot</h3><p>Your demo learning progress is <b>${appState.progress}%</b>.</p><div class="mini-progress"><i style="width:${appState.progress}%"></i></div><p>Task 1: 82% · Task 2: 46% · Task 3: 28%</p></div>`;
  if(tab==='chat') box.innerHTML=`<div class="content-box"><h3>AI Chat</h3><p>Ask the companion what to learn, request a simpler explanation, or tell it about a distraction.</p><button class="secondary-btn" onclick="$('#chatInput').focus()">Focus chat input</button></div>`;
}

$$('.tab').forEach(b=>b.addEventListener('click',()=>renderTab(b.dataset.tab)));

function sendMessage(text){
  text=(text||$('#chatInput').value).trim(); if(!text)return;
  $('#chatInput').value=''; $('#chatInput').style.height='42px';
  appState.messages.push({role:'user',text}); renderChatMessages();
  setAIState('thinking');
  setTimeout(()=>{appState.messages.push({role:'ai',text:mockAI(text)});renderChatMessages();setAIState('responding');setTimeout(()=>setAIState('idle'),1800)},700);
}
function mockAI(text){
  const t=text.toLowerCase();
  if(t.includes('today')||t.includes('learn')) return `Today, spend ${appState.profile.hours*15}–45 minutes on JavaScript DOM events. Learn the idea, practice 3 examples, then build one tiny interaction. Your next path step is ${['Foundation','Core Concepts','Guided Practice','Mini Project','Revision','Assessment','Next Level'][appState.pathStep]}.`;
  if(t.includes('simple')||t.includes('dom')) return 'Simple version: the DOM is your page as JavaScript sees it. Select an element, listen for an event, then change something on the page.';
  if(t.includes('distract')||t.includes('reset')) return 'Try a 30-second reset: put the phone away, take three slow breaths, then return for just one 5-minute action. Small wins count.';
  return `I’d connect that to your goal of ${appState.profile.goal}: start with one concept, one example and one small build. Tell me what feels difficult and I’ll adjust the demo path.`;
}
function renderChatMessages(){
  renderTab('chat'); const box=$('#tabContent');
  const messages=appState.messages.length?appState.messages:[{role:'ai',text:'Hi! I’m your personal learning companion. Ask me what to learn today or tell me where you’re stuck.'}];
  box.innerHTML=`<div class="content-box chat-messages">${messages.map(m=>`<div style="padding:10px 0;border-bottom:1px solid var(--line)"><span class="card-label">${m.role==='ai'?'AI':'YOU'}</span><p>${escapeHTML(m.text)}</p></div>`).join('')}</div>`;
}

$('#sendBtn').addEventListener('click',()=>sendMessage());$('#chatInput').addEventListener('keydown',e=>{if(e.key==='Enter'&&!e.shiftKey){e.preventDefault();sendMessage()}});$('#chatInput').addEventListener('input',e=>{e.target.style.height='42px';e.target.style.height=Math.min(e.target.scrollHeight,110)+'px'});
$('#chatPlus').addEventListener('click',()=>$('#quickActions').classList.toggle('open'));$$('.quick-actions button').forEach(b=>b.addEventListener('click',()=>{sendMessage(b.dataset.prompt);$('#quickActions').classList.remove('open')}));$('#jumpChat').addEventListener('click',()=>{ $('#chatBar').scrollIntoView({behavior:'smooth',block:'center'});$('#chatInput').focus()});

function setPathStep(step){appState.pathStep=Math.max(0,Math.min(6,step));$$('.path-step').forEach((b,i)=>b.classList.toggle('active',i===appState.pathStep));const names=['Foundation','Core Concepts','Guided Practice','Mini Project','Revision','Assessment','Next Level'];$('#pathHint').textContent=`Active step: ${names[appState.pathStep]}. ${appState.pathStep<6?'Complete the current practice to move forward.':'Your demo path has reached the Next Level.'}`;toast(`Learning path active step: ${names[appState.pathStep]}`)}
$$('.path-step').forEach(b=>b.addEventListener('click',()=>setPathStep(Number(b.dataset.step))));

function updateTaskProgress(){const checks=$$('.daily-check'),done=checks.filter(c=>c.checked).length,pct=Math.round(done/checks.length*100);$('#taskProgressText').textContent=`${done} / ${checks.length} complete`;$('#taskProgressBar').style.setProperty('--value',pct+'%');if(done===checks.length){appState.progress=Math.min(100,appState.progress+5);$('#progressOutput').textContent=appState.progress+'%';$('#mainProgress').style.width=appState.progress+'%';toast('Today’s task complete — progress updated!')}}
$$('.daily-check').forEach(c=>c.addEventListener('change',updateTaskProgress));
function completeAllTasks(){$$('.daily-check').forEach(c=>c.checked=true);updateTaskProgress()}
$('#completeTaskBtn').addEventListener('click',()=>{completeAllTasks();setPathStep(Math.min(6,appState.pathStep+1))});

function setFrequency(value){appState.frequency=Number(value);$$('.frequency-row button').forEach(b=>b.classList.toggle('active',Number(b.dataset.frequency)===appState.frequency));$$('#sideFrequency option').forEach(o=>o.selected=Number(o.value)===appState.frequency);const d=new Date();d.setDate(d.getDate()+appState.frequency);$('#checkinDate').textContent=new Intl.DateTimeFormat('en-IN',{month:'short',day:'numeric'}).format(d);$('#countdown').textContent=appState.frequency===7?'1 week':`${appState.frequency} days`;toast(`Check-in set to ${appState.frequency===7?'weekly':'every '+appState.frequency+' days'}`)}
$$('.frequency-row button').forEach(b=>b.addEventListener('click',()=>setFrequency(b.dataset.frequency)));$('#sideFrequency').addEventListener('change',e=>setFrequency(e.target.value));$('#checkinBtn').addEventListener('click',()=>{const questions=['What did you complete?','What was difficult?','How much time did you study?','What distracted you?','How confident are you?','Has your schedule changed?'];let i=0;const ask=()=>{if(i<questions.length){toast(questions[i]);i++;setTimeout(ask,900)}else{appState.progress=Math.min(100,appState.progress+3);$('#progressOutput').textContent=appState.progress+'%';$('#mainProgress').style.width=appState.progress+'%';toast('Check-in complete — demo path adapted +3%')}};ask()});

function updateExplanation(value){appState.explanation=Number(value);const d=explanationData[appState.explanation];$('#shortExplanation').textContent=d.text;$('#keyPoints').innerHTML=d.points.map(x=>`<li>${x}</li>`).join('');$('#codeExample').textContent=d.example;$('#quickQuestions').textContent=d.questions;$('#nextLearningStep').textContent=d.next;$('#sideExplanation').value=appState.explanation;$('#explanationSlider').value=appState.explanation;$('.explanation-control small').textContent=d.label}
$('#explanationSlider').addEventListener('input',e=>updateExplanation(e.target.value));$('#sideExplanation').addEventListener('input',e=>updateExplanation(e.target.value));

$('#themeSelect').addEventListener('change',e=>{appState.theme=e.target.value;document.body.classList.toggle('light',appState.theme==='light')});
$('#modeSelect').addEventListener('change',e=>{appState.mode=e.target.value;document.body.classList.remove('mode-calm','mode-energetic','mode-focus','mode-relaxed');document.body.classList.add('mode-'+appState.mode);toast('UI mode changed to '+e.target.options[e.target.selectedIndex].text)});
$('#animationToggle').addEventListener('change',e=>{appState.animation=e.target.checked;document.body.classList.toggle('no-animation',!appState.animation);toast(appState.animation?'Animation enabled':'Animation paused')});

$('#analyzeBtn').addEventListener('click',analyzePath);$('#onboardingBtn').addEventListener('click',()=>$('#onboardingModal').hidden=false);$('#closeOnboarding').addEventListener('click',()=>$('#onboardingModal').hidden=true);
$('#onboardingForm').addEventListener('submit',e=>{e.preventDefault();const fd=new FormData(e.target);appState.profile.name=fd.get('name')||'Student';appState.profile.goal=fd.get('goal')||'Personal learning';appState.profile.level=fd.get('level');appState.profile.hours=Number(fd.get('hours'))||2;appState.profile.schedule=fd.get('schedule');appState.profile.habits=fd.get('habits');$('#profileName').textContent=appState.profile.name;$('#profileGoal').textContent=appState.profile.goal;$('#avatarInitial').textContent=appState.profile.name.charAt(0).toUpperCase();$('#goalOutput').textContent='Become a '+appState.profile.goal.replace(/^become a\s+/i,'');$('#timeOutput').textContent=Math.max(15,Math.round(appState.profile.hours*30))+' minutes';setFrequency(fd.get('frequency'));const mood=(fd.get('mood')||'Calm').toLowerCase().split(' ')[0].replace('/','');$('#modeSelect').value=['calm','energetic','focus','relaxed'].includes(mood)?mood:'calm';$('#modeSelect').dispatchEvent(new Event('change'));$('#onboardingModal').hidden=true;analyzePath();toast('Profile saved. Your personal path is being analyzed.')});

$('#notesUpload').addEventListener('change',e=>{const file=e.target.files[0];if(!file)return;processNotes(file.name)});
function processNotes(name){const box=$('#processingBox'),result=$('#notesResult'),text=$('#processingText'),step=$('#processingStep');box.hidden=false;result.style.opacity='.35';const steps=['Extracting text...','Analyzing content...','Understanding concepts...','Creating personalized notes...'];let i=0;text.textContent=steps[0];step.textContent='1 / 4';const timer=setInterval(()=>{i++;if(i>=steps.length){clearInterval(timer);text.textContent='Personalized notes ready';step.textContent='✓';result.style.opacity='1';setTimeout(()=>box.hidden=true,600);toast('Notes analyzed in demo mode — no file was sent anywhere.');return}text.textContent=steps[i];step.textContent=`${i+1} / 4`},800)}

$('#refreshmentBtn').addEventListener('click',()=>{const items=['Riddle: What has keys but cannot open locks? A keyboard.','Reset: inhale 4 seconds, exhale 6 seconds — repeat three times.','Fun fact: The first website went live in 1991.','Mini joke: Why did the developer go broke? Because they used up all their cache.'];toast(items[Math.floor(Math.random()*items.length)])});

$('#menuBtn').addEventListener('click',()=>{$('#sidebar').classList.add('open');$('#drawerScrim').classList.add('open')});$('#closeDrawer').addEventListener('click',closeDrawer);$('#drawerScrim').addEventListener('click',closeDrawer);function closeDrawer(){$('#sidebar').classList.remove('open');$('#drawerScrim').classList.remove('open')}
$$('.section-title').forEach(b=>b.addEventListener('click',()=>{const target=document.getElementById(b.dataset.scroll);if(target&&window.innerWidth<=800){target.scrollIntoView({behavior:'smooth',block:'nearest'})}}));

setFrequency(2);updateExplanation(1);renderTab('learning');animateBars();