<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Escáner QR - Eduessence</title>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/minified/html5-qrcode.min.js"></script>
</head>

<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f8ff;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #002c74;
        }

        #reader {
            margin: 0 auto;
            margin-top: 20px;
            width: 320px;
            max-width: 90vw;
            border: 2px dashed #002c74;
            padding: 10px;
            border-radius: 10px;
            background-color: white;
        }

        #result {
            margin: 20px auto;
            width: 320px;
            max-width: 90vw;
            background: #e9f5e9;
            padding: 10px;
            border: 1px solid #a0d7a0;
            border-radius: 5px;
            color: #2a5c2a;
            font-size: 14px;
            white-space: pre-wrap;
        }

    </style>
    <h2>Escanea tu código QR</h2>
    <div id="reader" style="width:300px;"></div>
    <div id="result"></div>

    <form id="qrForm" method="POST" action="procesar.php" style="display:none;">
        <input type="hidden" name="action" id="form-action">
        <input type="hidden" name="control" id="form-control">
        <input type="hidden" name="cursoId" id="form-cursoId">
        <input type="hidden" name="userid" id="form-userid">
    </form>

    <script>
        function parseQuery(queryString) {
            const params = new URLSearchParams(queryString);
            const result = {};
            for (const [key, value] of params.entries()) {
                result[key] = value;
            }
            return result;
        }

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText.includes("eduessence.com")) {
                // Solo detener escaneo después de éxito
                html5QrcodeScanner.clear();

                const query = decodedText.split("?")[1];
                const params = parseQuery(query);

                // Mostrar en pantalla (debug)
                document.getElementById("result").innerText = "Datos escaneados:\n" + JSON.stringify(params, null, 2);

                // Llenar el formulario oculto
                if (params.action) document.getElementById("form-action").value = params.action;
                if (params.control) document.getElementById("form-control").value = params.control;
                if (params.cursoId) document.getElementById("form-cursoId").value = params.cursoId;
                if (params.userid) document.getElementById("form-userid").value = params.userid;

                // Enviar el formulario al servidor PHP
                document.getElementById("qrForm").submit();
            }
        }

        const html5QrcodeScanner = new Html5Qrcode("reader");

        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                html5QrcodeScanner.start(
                    { facingMode: "environment" }, // usa la cámara trasera
                    {
                        fps: 10,
                        qrbox: 250
                    },
                    onScanSuccess
                );
            } else {
                alert("No se encontró ninguna cámara.");
            }
        }).catch(err => {
            console.error("Error al acceder a la cámara:", err);
            alert("No se pudo acceder a la cámara. Verifica los permisos del navegador.");
        });
    </script>

</body>

</html>