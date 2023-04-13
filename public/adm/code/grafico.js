var canvasGraficos=[],dadosGraficos=[];
window.addEventListener("load", function (){




    var canvasElementos=ehquery("#dashboardbloco canvas");
    for (let i = 0; i < canvasElementos.length; i++) {
        canvasGraficos[canvasElementos[i].id]=canvasElementos[i];
    }
    
    for (const key in canvasGraficos) {
        var tituloCard="titulo padrão";
        if(canvasGraficos[key].getAttribute("data-titulo")!=null && canvasGraficos[key].getAttribute("data-titulo")!=undefined){
            tituloCard=canvasGraficos[key].getAttribute("data-titulo");
        }
        dadosGraficos[key]={
            type:canvasGraficos[key].getAttribute("data-type"),
            options:{
                plugins: {
                    title: {
                        display: true,
                        text: tituloCard
                    }
                },
                layout: {
                    padding: 5
                },
                aspectRatio:canvasGraficos[key].parentElement.offsetWidth/canvasGraficos[key].parentElement.offsetHeight
            }
        }
    }

    dadosGraficos["nomegrafico2"]["data"]={
        labels: [
          'Red',
          'Green',
          'Yellow',
          'Grey',
          'Blue'
        ],
        datasets: [{
          label: 'My First Dataset',
          data: [11, 16, 7, 3, 14],
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(75, 192, 192)',
            'rgb(255, 205, 86)',
            'rgb(201, 203, 207)',
            'rgb(54, 162, 235)'
          ]
        }]
    };

    dadosGraficos["nomegrafico4"]["data"]={
        labels: [
            'Fechados',
            'Abertos'
        ],
        datasets: [{
            label: 'Quantidade',
            data: [300, 50],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)'
            ],
            hoverOffset: 4
        }]
    };

    dadosGraficos["nomegrafico6"]["data"]={
        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        datasets: [{
            label: 'Contratações',
            data: [12, 19, 3, 5, 2, 3,12, 19, 3, 5, 2, 3],
            borderWidth: 1,
            fill: false,
            borderColor: 'green',
            tension: 0.1
        },
        {
            label: 'Churn',
            data: [2, 4, -1, 3, -2, 1,10, 20, 10, 3, 4, 2],
            borderWidth: 1,
            fill: false,
            borderColor: "lightblue",
            tension: 0.1
        },
        {
            label: 'Cancelamento',
            data: [10, 15, 4, 2, 4, 5,10, 20, 10, 3, 4, 2],
            borderWidth: 1,
            fill: false,
            borderColor: "red",
            tension: 0.1
        }]
    };

    dadosGraficos["nomegrafico7"]["data"]={
        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3,12, 19, 3, 5, 2, 3],
            borderWidth: 1
        }]
    };




    /*
    
    dadosGraficos[canvasGraficos[4]]={
        "nomegrafico2":{
            type: 'polarArea',
            data: {
                labels: [
                  'Red',
                  'Green',
                  'Yellow',
                  'Grey',
                  'Blue'
                ],
                datasets: [{
                  label: 'My First Dataset',
                  data: [11, 16, 7, 3, 14],
                  backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(255, 205, 86)',
                    'rgb(201, 203, 207)',
                    'rgb(54, 162, 235)'
                  ]
                }]
            },
            options:{
                aspectRatio:canvasGraficos[1].parentElement.offsetWidth/canvasGraficos[1].parentElement.offsetHeight
            }
            
        },
        "nomegrafico4" : {
            type: 'doughnut',
            data: {
                labels: [
                    'Red',
                    'Blue',
                    'Yellow'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
            options:{
                aspectRatio:canvasGraficos[5].parentElement.offsetWidth/canvasGraficos[5].parentElement.offsetHeight
            }
        },
        "nomegrafico6" : {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3,12, 19, 3, 5, 2, 3],
                    borderWidth: 1,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options:{
                aspectRatio:canvasGraficos[7].parentElement.offsetWidth/canvasGraficos[7].parentElement.offsetHeight
            }
        },
        "nomegrafico7" : {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3,12, 19, 3, 5, 2, 3],
                    borderWidth: 1
                }]
            },
            options:{
                aspectRatio:canvasGraficos[8].parentElement.offsetWidth/canvasGraficos[8].parentElement.offsetHeight
            }
        },
    }
    */
    constroigrafico(canvasGraficos);
});

function constroidados(canvaEl,index){
    console.log("idn:"+index)
    dadosGraficos[index]={
            options:{
                aspectRatio:canvaEl.parentElement.offsetWidth/canvaEl.parentElement.offsetHeight
            }
        }
}

function constroigrafico(listagraficos){
    Chart.defaults.color="white";
    for (const key in listagraficos) {
        new Chart(listagraficos[key], dadosGraficos[key]);
    }
}

function constroiGraficos(graficosElementos){
    Chart.defaults.color = "white";
    for (let i = 0; i < graficosElementos.length; i++) {
        new Chart(graficosElementos[i], dadosGraficos[graficosElementos[i].id]);
    }
}