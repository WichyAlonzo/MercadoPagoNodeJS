const axios = require('axios');
const readline = require('readline');
const urlBase = 'http://localhost';

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

console.log('CactusPay v1.0.0');
console.log('======================');
// Función para leer datos del usuario desde la consola
function promptUser(question) {
    return new Promise((resolve, reject) => {
        rl.question(question, answer => {
            resolve(answer);

        });
    });
}

// Función para enviar los datos mediante la solicitud POST
async function sendPostData() {
    const code = await promptUser('Escribe el Código: ');
    const nombre = await promptUser('Escribe el Nombre: ');
    const price = await promptUser('Escribe el Precio: ');
    const phone = await promptUser('Escribe el Teléfono: ');

    // Datos a enviar en la solicitud POST como datos de formulario
    const postData = new URLSearchParams({
        code: code,
        nombre: nombre,
        price: price,
        phone: phone
    }).toString();

    // URL del archivo PHP en el servidor que procesará los datos
    const url = `${urlBase}/x.php`;

    // Configuración de la solicitud POST
    const options = {
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    };

    // Realizar la solicitud POST para enviar los datos al servidor
    axios.post(url, postData, options)
        .then(response => {
            console.log('se subio el contenido');
            console.log(`${urlBase}/index?code=${code}`)
            sendPostData();

        })
        .catch(error => {
            console.error('Error al enviar los datos:', error);
            sendPostData();

        });
}
sendPostData();
rl.on('close', () => {
    console.log('Entrada cancelada. Saliendo...');
    process.exit(0);

});