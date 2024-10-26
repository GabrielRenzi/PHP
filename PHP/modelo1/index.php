<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação de Serviços - HRAV</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        h1 {
            color: #005ba3;
        }
        .form-container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
        }
        .question {
            font-size: 18px;
            margin-bottom: 15px;
        }
        .scale {
            display: flex;
            justify-content: space-between;
            margin: 10px 0 20px 0;
        }
        .scale label {
            width: 30px;
            text-align: center;
        }
        .navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        button {
            background-color: #005ba3;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        .feedback-container {
            margin-top: 20px;
        }
        textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            resize: vertical;
        }
        .anonimato {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: gray;
        }
    </style>
</head>
<body>

    <h1>Avaliação de Serviços</h1>

    <div class="form-container">
        <form id="evaluation-form">
            <div id="question-container">
                <!-- Pergunta atual será inserida aqui -->
            </div>

            <div class="navigation">
                <button type="button" id="prev-btn" disabled>Anterior</button>
                <button type="button" id="next-btn">Próximo</button>
            </div>

            <div class="feedback-container" id="feedback-container" style="display: none;">
                <label for="feedback">Comentários adicionais (opcional):</label>
                <textarea id="feedback" name="feedback" placeholder="Escreva seu feedback aqui..."></textarea>
            </div>

            <button type="submit" id="submit-btn" style="display: none;">Enviar Avaliação</button>

            <!-- Aviso de anonimato -->
            <div class="anonimato">
                <p>Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.</p>
            </div>
        </form>
    </div>

    <script>
        let questions = [];
        let currentQuestionIndex = 0;
        let responses = [];

        document.addEventListener('DOMContentLoaded', () => {
            fetchQuestions();

            document.getElementById('next-btn').addEventListener('click', showNextQuestion);
            document.getElementById('prev-btn').addEventListener('click', showPrevQuestion);
            document.getElementById('evaluation-form').addEventListener('submit', submitEvaluation);
        });

        function fetchQuestions() {
            fetch('get_questions.php')
                .then(response => response.json())
                .then(data => {
                    questions = data;
                    if (questions.length > 0) {
                        displayQuestion();
                    } else {
                        document.getElementById('question-container').innerHTML = '<p>Nenhuma pergunta disponível.</p>';
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar perguntas:', error);
                    document.getElementById('question-container').innerHTML = '<p>Erro ao carregar as perguntas.</p>';
                });
        }

        function displayQuestion() {
            const question = questions[currentQuestionIndex];
            const questionContainer = document.getElementById('question-container');
            questionContainer.innerHTML = `
                <div class="question">${currentQuestionIndex + 1}. ${question.question_text}</div>
                <div class="scale">
                    ${generateScale(question.id)}
                </div>
            `;

            const existingResponse = responses.find(r => r.question_id === question.id);
            if (existingResponse) {
                document.querySelector(`input[name="question-${question.id}"][value="${existingResponse.score}"]`).checked = true;
            }

            document.getElementById('prev-btn').disabled = currentQuestionIndex === 0;
            if (currentQuestionIndex === questions.length - 1) {
                document.getElementById('next-btn').style.display = 'none';
                document.getElementById('submit-btn').style.display = 'block';
                document.getElementById('feedback-container').style.display = 'block';
            } else {
                document.getElementById('next-btn').style.display = 'block';
                document.getElementById('submit-btn').style.display = 'none';
                document.getElementById('feedback-container').style.display = 'none';
            }
        }

        function generateScale(questionId) {
            let scale = '';
            for (let i = 1; i <= 10; i++) {
                scale += `
                    <label>
                        <input type="radio" name="question-${questionId}" value="${i}">
                        ${i}
                    </label>
                `;
            }
            return scale;
        }

        function showNextQuestion() {
            saveResponse();
            if (currentQuestionIndex < questions.length - 1) {
                currentQuestionIndex++;
                displayQuestion();
            }
        }

        function showPrevQuestion() {
            saveResponse();
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                displayQuestion();
            }
        }

        function saveResponse() {
            const question = questions[currentQuestionIndex];
            const selectedScore = document.querySelector(`input[name="question-${question.id}"]:checked`);
            if (selectedScore) {
                const existingResponse = responses.find(r => r.question_id === question.id);
                if (existingResponse) {
                    existingResponse.score = parseInt(selectedScore.value);
                } else {
                    responses.push({
                        question_id: question.id,
                        score: parseInt(selectedScore.value)
                    });
                }
            }
        }

        function submitEvaluation(event) {
            event.preventDefault();
            saveResponse();

            const feedback = document.getElementById('feedback').value;
            const evaluationData = {
                responses: responses,
                feedback: feedback
            };

            fetch('submit_responses.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(evaluationData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Erro ao enviar avaliação: ' + data.error);
                } else {
                    alert('Avaliação enviada com sucesso!');
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Erro ao enviar avaliação:', error);
                alert('Erro ao enviar avaliação.');
            });
        }
    </script>

</body>
</html>
