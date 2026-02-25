// Campaign Site - Interactive Policy Alignment Quiz
// Helps voters understand where they stand on key issues

const quizData = [
    {
        question: "How should we address affordable housing in District 12?",
        options: [
            { text: "Prioritize new construction of affordable units", alignment: "progressive", popular: 42 },
            { text: "Re-zone transit corridors for mixed-income development", alignment: "pragmatic", popular: 35 },
            { text: "Offer tax incentives to developers who include affordable units", alignment: "market", popular: 23 }
        ]
    },
    {
        question: "What's your top priority for public schools?",
        options: [
            { text: "Reduce class sizes by hiring more teachers", alignment: "progressive", popular: 48 },
            { text: "Increase teacher salaries to attract better talent", alignment: "pragmatic", popular: 31 },
            { text: "Expand charter school options", alignment: "market", popular: 21 }
        ]
    },
    {
        question: "How should we improve public safety?",
        options: [
            { text: "Pair police with mental health crisis responders", alignment: "pragmatic", popular: 52 },
            { text: "Invest more in community programs and prevention", alignment: "progressive", popular: 33 },
            { text: "Increase police presence in high-crime areas", alignment: "traditional", popular: 15 }
        ]
    },
    {
        question: "What's the best approach to transit expansion?",
        options: [
            { text: "Fast-track Metro Extension even with small tax increase", alignment: "pragmatic", popular: 46 },
            { text: "Focus on improving bus service first (lower cost)", alignment: "fiscal", popular: 32 },
            { text: "Wait for state/federal funding before committing", alignment: "cautious", popular: 22 }
        ]
    }
];

let currentQuestion = 0;
let userAnswers = [];

function renderQuiz() {
    const quizContainer = document.getElementById('voter-quiz');
    if (!quizContainer) return;

    // Initial render
    if (currentQuestion === 0 && userAnswers.length === 0) {
        quizContainer.innerHTML = `
            <div class="quiz-intro" style="text-align: center; padding: 2rem;">
                <h3 style="font-family: 'Merriweather', serif; font-size: 1.8rem; color: var(--atp-navy); margin-bottom: 1rem;">
                    Where Do You Stand?
                </h3>
                <p style="font-size: 1.1rem; color: var(--text-light); margin-bottom: 2rem; line-height: 1.6;">
                    Answer 4 quick questions to see how your views align with your neighbors in District 12.
                </p>
                <button onclick="startQuiz()" class="btn-primary" style="font-size: 1rem; padding: 1rem 3rem;">
                    Start Quiz
                </button>
            </div>
        `;
        return;
    }

    // Show question
    if (currentQuestion < quizData.length) {
        const q = quizData[currentQuestion];
        const progress = ((currentQuestion + 1) / quizData.length) * 100;

        quizContainer.innerHTML = `
            <div class="quiz-progress" style="height: 4px; background: var(--atp-grey); margin-bottom: 2rem; border-radius: 2px; overflow: hidden;">
                <span style="display: block; height: 100%; background: var(--atp-red); width: ${progress}%; transition: width 0.3s ease;"></span>
            </div>
            <div class="quiz-meta" style="text-align: center; font-size: 0.9rem; color: var(--text-light); margin-bottom: 1.5rem;">
                Question ${currentQuestion + 1} of ${quizData.length}
            </div>
            <div class="quiz-question" style="font-family: 'Merriweather', serif; font-size: 1.6rem; color: var(--atp-navy); margin-bottom: 2rem; line-height: 1.3;">
                ${q.question}
            </div>
            <div class="quiz-options" style="display: grid; gap: 1rem; margin-bottom: 2rem;">
                ${q.options.map((opt, idx) => `
                    <button class="quiz-btn" onclick="selectAnswer(${idx})" style="background: var(--atp-cream); border: 2px solid var(--atp-grey); padding: 1.5rem; text-align: left; font-family: 'Inter', sans-serif; font-size: 1.1rem; font-weight: 600; color: var(--atp-navy); cursor: pointer; transition: all 0.2s; border-radius: 4px; position: relative;">
                        ${opt.text}
                        <span class="quiz-stat-pop" style="float: right; font-size: 0.9rem; font-weight: 400; opacity: 0; color: var(--atp-red);">
                            ${opt.popular}% agree
                        </span>
                    </button>
                `).join('')}
            </div>
        `;
    } else {
        // Show results
        showResults();
    }
}

function startQuiz() {
    currentQuestion = 0;
    userAnswers = [];
    renderQuiz();
}

function selectAnswer(optionIndex) {
    const q = quizData[currentQuestion];
    userAnswers.push({
        question: currentQuestion,
        selected: optionIndex,
        alignment: q.options[optionIndex].alignment,
        popular: q.options[optionIndex].popular
    });

    // Visual feedback
    const buttons = document.querySelectorAll('.quiz-btn');
    buttons.forEach((btn, idx) => {
        if (idx === optionIndex) {
            btn.style.background = 'var(--atp-navy)';
            btn.style.color = 'white';
            btn.style.borderColor = 'var(--atp-navy)';
            const statPop = btn.querySelector('.quiz-stat-pop');
            if (statPop) {
                statPop.style.opacity = '1';
                statPop.style.color = 'white';
            }
        }
    });

    // Move to next question after short delay
    setTimeout(() => {
        currentQuestion++;
        renderQuiz();
    }, 800);
}

function showResults() {
    const quizContainer = document.getElementById('voter-quiz');
    if (!quizContainer) return;

    // Calculate alignment scores
    const alignmentCounts = {};
    userAnswers.forEach(ans => {
        alignmentCounts[ans.alignment] = (alignmentCounts[ans.alignment] || 0) + 1;
    });

    const sortedAlignments = Object.entries(alignmentCounts).sort((a, b) => b[1] - a[1]);
    const topAlignment = sortedAlignments[0][0];

    // Calculate agreement with Sarah's platform
    const sarahPlatform = ['pragmatic', 'pragmatic', 'pragmatic', 'pragmatic']; // Sarah's stances
    let agreementCount = 0;
    userAnswers.forEach((ans, idx) => {
        if (ans.alignment === sarahPlatform[idx]) {
            agreementCount++;
        }
    });
    const agreementPercent = Math.round((agreementCount / quizData.length) * 100);

    const alignmentLabels = {
        'progressive': 'Progressive Reform',
        'pragmatic': 'Data-Driven Pragmatist',
        'market': 'Market-Based Solutions',
        'traditional': 'Traditional Approach',
        'fiscal': 'Fiscal Conservative',
        'cautious': 'Cautious Incrementalist'
    };

    const alignmentDescriptions = {
        'progressive': 'You prioritize bold, systemic change to address inequality and expand social programs.',
        'pragmatic': 'You favor evidence-based solutions that balance idealism with fiscal reality. This aligns closely with Sarah\'s platform.',
        'market': 'You believe market incentives and private sector partnerships are the best path to progress.',
        'traditional': 'You value proven methods and community-focused approaches over rapid change.',
        'fiscal': 'You prioritize fiscal responsibility and cost-effectiveness in all policy decisions.',
        'cautious': 'You prefer incremental progress with minimal risk over ambitious but uncertain reforms.'
    };

    quizContainer.innerHTML = `
        <div class="quiz-results" style="text-align: center;">
            <div class="result-header" style="margin-bottom: 2rem;">
                <h2 style="font-size: 2.5rem; color: var(--atp-navy); margin-bottom: 1rem; font-family: 'Merriweather', serif;">
                    ${alignmentLabels[topAlignment] || 'Your Results'}
                </h2>
                <p style="font-size: 1.1rem; color: var(--text-light); line-height: 1.6; max-width: 600px; margin: 0 auto 2rem;">
                    ${alignmentDescriptions[topAlignment] || ''}
                </p>
            </div>

            <div class="result-alignment-box" style="background: var(--atp-cream); border: 2px solid var(--atp-navy); border-radius: 8px; padding: 2rem; margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto;">
                <div style="font-size: 0.9rem; text-transform: uppercase; color: var(--text-light); margin-bottom: 0.5rem; font-weight: 700; letter-spacing: 0.1em;">
                    Alignment with Sarah's Platform
                </div>
                <div style="font-size: 4rem; font-weight: 700; color: var(--atp-red); font-family: 'Merriweather', serif; line-height: 1; margin-bottom: 0.5rem;">
                    ${agreementPercent}%
                </div>
                <p style="font-size: 0.95rem; color: var(--text-light);">
                    You agreed on ${agreementCount} out of ${quizData.length} key issues
                </p>
            </div>

            <div class="result-breakdown" style="text-align: left; max-width: 600px; margin: 0 auto 2rem;">
                <h3 style="font-size: 1.3rem; color: var(--atp-navy); margin-bottom: 1rem; font-family: 'Merriweather', serif;">
                    How You Compare to District 12
                </h3>
                ${userAnswers.map((ans, idx) => {
                    const q = quizData[idx];
                    const option = q.options[ans.selected];
                    return `
                        <div class="result-row" style="margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--atp-grey);">
                            <div style="font-size: 0.85rem; color: var(--text-light); margin-bottom: 0.5rem; font-weight: 600;">
                                ${q.question}
                            </div>
                            <div style="font-size: 1rem; color: var(--atp-navy); margin-bottom: 0.5rem; font-weight: 600;">
                                ${option.text}
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div class="result-bar-bg" style="flex: 1; height: 12px; background: var(--atp-grey); border-radius: 10px; overflow: hidden;">
                                    <div class="result-bar-fill" style="height: 100%; background: var(--atp-navy); width: ${option.popular}%;"></div>
                                </div>
                                <span style="font-size: 0.9rem; color: var(--text-light); font-weight: 600; min-width: 50px;">
                                    ${option.popular}% agree
                                </span>
                            </div>
                        </div>
                    `;
                }).join('')}
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                <button onclick="startQuiz()" class="btn-secondary" style="margin-right: 1rem;">
                    Retake Quiz
                </button>
                <a href="#connect" class="btn-primary">
                    Join the Campaign
                </a>
            </div>
        </div>
    `;
}

// Initialize quiz on page load
document.addEventListener('DOMContentLoaded', () => {
    renderQuiz();
});
