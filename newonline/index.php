<!DOCTYPE html>
<html lang="pt-BR">
    <head>

        <meta charset="utf-8">
        <title>Home</title>
        <script src="https://kit.fontawesome.com/6bef072b61.js" crossorigin="anonymous"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const apiKey = 'bdfcd9b8a6b1859f92dfa580a22542ef'; // Substitua pela sua chave de API da OpenWeatherMap
                const cidade = 'São Paulo';

                const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${cidade}&lang=pt&appid=${apiKey}`;

                fetch(apiUrl, { mode: 'cors' })
                .then(response => response.json())
                .then(data => {
                    // Convertendo a temperatura de Kelvin para Celsius
                    const temperaturaCelsius = data.main.temp - 273.15;

                    // Exibe as informações de clima
                    const weatherInfo = document.getElementById('clima-info');
                    weatherInfo.innerHTML = `
                        <i class="fa-solid fa-cloud fa-2xl"></i>
                        <p>Cidade: ${data.name}</p>
                        <p>Condição: ${data.weather[0].description}</p>
                        <p>Temperatura: ${temperaturaCelsius.toFixed(2)}°C</p>
                        <p>Umidade: ${data.main.humidity}%</p>
                    `;
                })
                .catch(error => console.error('Erro ao obter dados do clima:', error));
                    });
                    document.addEventListener('DOMContentLoaded', function () {
                        const saudacaoElement = document.getElementById('saudacao');
                        const horaAtual = new Date().getHours();

                        let saudacao;

                        if (horaAtual >= 5 && horaAtual < 12) {
                            saudacao = 'Bom dia, ';
                        } else if (horaAtual >= 12 && horaAtual < 18) {
                            saudacao = 'Boa tarde, ';
                        } else {
                            saudacao = 'Boa noite, ';
                        }

                        saudacaoElement.textContent = saudacao;
                    });
        </script>
    </head>
    <body>      
        <?php 
            include 'menu.php';
        ?>
        
        <div class="main-content-index">
                <div class="saudacao">
                
                    <h1><p id="saudacao"></p><?php echo $_SESSION['usu_nome'] ?></h1>
                    <div id="clima-info"></div>
                </div>          
        </div>  
    </body>
</html>
