<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Escáner QR - Eduessence</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
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

        #cameraSelect {
            display: block;
            margin: 0 auto;
            margin-top: 10px;
            padding: 5px;
            font-size: 16px;
        }

        #reader {
            margin: 20px auto;
            width: 320px;
            max-width: 95%;
            border: 2px dashed #004aad;
            border-radius: 10px;
            padding: 10px;
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
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Escanea tu código QR</h2>
<select id="cameraSelect">
    <option disabled selected>Selecciona una cámara...</option>
</select>
<div id="reader"></div>
<div id="result"></div>

<form id="qrForm" method="POST" action="procesar.php" style="display:none;">
    <input type="hidden" name="action" id="form-action">
    <input type="hidden" name="control" id="form-control">
    <input type="hidden" name="cursoId" id="form-cursoId">
    <input type="hidden" name="userid" id="form-userid">
</form>

<script>
    const cameraSelect = document.getElementById("cameraSelect");
    const readerContainer = document.getElementById("reader");
    let html5QrCode;

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
            html5QrCode.stop().then(() => {
                const query = decodedText.split("?")[1];
                const params = parseQuery(query);

                const resultDiv = document.getElementById("result");
                resultDiv.innerHTML = `
                    ✅ <strong>Código QR leído correctamente</strong><br>
                    <small>${decodedText}</small>
                `;
                resultDiv.style.backgroundColor = "#d4edda";
                resultDiv.style.color = "#155724";

                if (params.action) document.getElementById("form-action").value = params.action;
                if (params.control) document.getElementById("form-control").value = params.control;
                if (params.cursoId) document.getElementById("form-cursoId").value = params.cursoId;
                if (params.userid) document.getElementById("form-userid").value = params.userid;

                setTimeout(() => {
                    document.getElementById("qrForm").submit();
                }, 1000);
            });
        }
    }

    // Listar cámaras disponibles
    Html5Qrcode.getCameras().then(devices => {
        if (devices.length === 0) {
            alert("No se encontraron cámaras.");
            return;
        }

        devices.forEach(device => {
            const option = document.createElement("option");
            option.value = device.id;
            option.text = device.label || `Cámara ${cameraSelect.length}`;
            cameraSelect.appendChild(option);
        });

        cameraSelect.addEventListener("change", () => {
            const selectedCameraId = cameraSelect.value;

            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    html5QrCode.clear();
                    startCamera(selectedCameraId);
                }).catch(err => {
                    console.error("Error al detener cámara anterior:", err);
                });
            } else {
                startCamera(selectedCameraId);
            }
        });
    }).catch(err => {
        console.error("Error al acceder a las cámaras:", err);
        alert("No se pudo acceder a la cámara. Verifica permisos del navegador.");
    });

    function startCamera(cameraId) {
        html5QrCode = new Html5Qrcode("reader");

        html5QrCode.start(
            cameraId,
            {
                fps: 10,
                qrbox: 250
            },
            onScanSuccess,
            (errorMessage) => {
                console.warn("Falló el intento de escaneo:", errorMessage);
            }
        ).catch(err => {
            console.error("Error al iniciar escaneo:", err);
            alert("No se pudo iniciar el escaneo con esta cámara.");
        });
    }
</script>

</body>
</html>
