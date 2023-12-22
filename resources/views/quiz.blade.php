<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased">

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quiz</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #f7f7f7;
            }
            .quiz-container {
                width: 100%;
                max-width: 600px;
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .question {
                margin-bottom: 20px;
            }
            .question label {
                display: block;
            }
            #restart-btn{
                display: none;
            }
            button {
                display: block;
                width: 100%;
                padding: 10px;
                margin-top: 10px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
    @if($data)
    <div class="quiz-container">
        <div id="quiz"></div>
        <button id="next-btn" onclick="showNextQuestion()">Next</button>
        <button id="restart-btn" onclick="window.location.href='/quiz'">Restart Quiz</button>

    </div>

    <script>
        const questions = @json($data);
        let currentQuestionIndex = 0;
        const quizContainer = document.getElementById('quiz');
        const nextButton = document.getElementById('next-btn');
        const restartButton = document.getElementById('restart-btn');
        let userAnswers = [];

        function showQuestion(index) {
            const question = questions[index];
            const html = `
            <div class="question">
                <h2>Q${index + 1}: ${question.question}</h2>
                ${[...question.incorrect_answers, question.correct_answer].sort().map(answer =>
                `<label>
                        <input type="radio" name="answer" value="${answer}">
                        ${answer}
                    </label>`
            ).join('')}
            </div>
        `;
            quizContainer.innerHTML = html;
        }

        function showNextQuestion() {
            const selectedAnswer = quizContainer.querySelector('input[name="answer"]:checked');
            if (!selectedAnswer) {
                alert('Please select an answer.');
                return;
            }

            userAnswers[currentQuestionIndex] = {
                question: questions[currentQuestionIndex].question,
                answer: selectedAnswer.value,
            };

            currentQuestionIndex++;
            if (currentQuestionIndex < questions.length) {
                showQuestion(currentQuestionIndex);
            } else {
                quizContainer.innerHTML = '<h1>Quiz Completed!</h1>';
                restartButton.style.display = 'block';
                nextButton.textContent = 'Do it again';
                nextButton.onclick = restartQuiz;
                userAnswers.forEach((userAnswer, index) => {
                    const questionElement = document.createElement('div');
                    questionElement.innerHTML = `
                    <p><strong>Question:</strong> ${userAnswer.question}</p>
                    <p><strong>Your Answer:</strong> ${userAnswer.answer}</p>
                `;
                    quizContainer.appendChild(questionElement);
                });
            }
        }

        function restartQuiz() {
            // Reset the quiz
            currentQuestionIndex = 0;
            userAnswers = [];
            nextButton.textContent = 'Next';
            nextButton.onclick = showNextQuestion;
            showQuestion(currentQuestionIndex);
        }

        showQuestion(currentQuestionIndex);
    </script>
    @else
        <p>No data found.</p>
    @endif

    </body>
    </html>



    </body>
</html>
