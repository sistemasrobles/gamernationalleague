var clock = new Date("2024-05-17 22:00:00"); 
var intervalo = setInterval(mostrar_hora, 1000); 

function mostrar_hora() {
    var now = new Date();
    var distancia = clock - now; 

    if (distancia > 0) {
        var dias = Math.floor(distancia / (1000 * 60 * 60 * 24));
        var horas = Math.floor((distancia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutos = Math.floor((distancia % (1000 * 60 * 60)) / (1000 * 60));
        var segundos = Math.floor((distancia % (1000 * 60)) / 1000);

        // Mostrar los resultados en los elementos correspondientes
        document.getElementById('dia').innerHTML = dias;
        document.getElementById('hora').innerHTML = horas;
        document.getElementById('minuto').innerHTML = minutos;
        document.getElementById('segundo').innerHTML = segundos;
    } else {
        // Cuando la cuenta regresiva finaliza
        clearInterval(intervalo);
        document.getElementById('cuentaRegresiva').innerHTML = "¡Tiempo expirado!";
    }
}

mostrar_hora(); 