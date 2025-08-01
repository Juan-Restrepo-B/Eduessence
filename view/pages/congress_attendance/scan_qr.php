<?php
session_start();
$usuario = $_SESSION['useremail'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
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

    <!-- Formulario oculto -->
    <form id="qrForm" method="POST" action="/procesar" style="display:none;">
        <input type="hidden" name="action" id="form-action">
        <input type="hidden" name="control" id="form-control">
        <input type="hidden" name="cursoId" id="form-cursoId">
    </form>

    <script>
        const cameraSelect = document.getElementById("cameraSelect");
        let html5QrCode;

        function parseQuery(queryString) {
            const result = {};
            const urlParams = new URLSearchParams(queryString);
            for (const [key, value] of urlParams.entries()) {
                result[key.toLowerCase()] = value;
            }
            return result;
        }

        function onScanSuccess(decodedText) {
            console.log("Texto del QR:", decodedText); // ✅ Verifica qué se recibe

            const parts = decodedText.split("?");
            if (parts.length < 2) return;

            const params = parseQuery(parts[1]);
            const action = params["action"] || "";
            const control = params["control"] || "";
            const cursoId = params["cursoid"] || "";

            // ✅ Mostrar resultado
            document.getElementById("result").innerHTML = `
      ✅ <strong>QR leído correctamente</strong><br>
      Acción: ${action}<br>
      Control: ${control}<br>
      Curso ID: ${cursoId}
    `;

            // ✅ Enviar datos si existen
            if (action && control && cursoId) {
                document.getElementById("form-action").value = action;
                document.getElementById("form-control").value = control;
                document.getElementById("form-cursoId").value = cursoId;

                setTimeout(() => {
                    document.getElementById("qrForm").submit();
                }, 1000);
            } else {
                alert("⚠️ El QR no contiene todos los parámetros requeridos.");
            }

            html5QrCode.stop(); // detener escaneo una vez leído
        }

        Html5Qrcode.getCameras().then(devices => {
            if (!devices.length) {
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
                    });
                } else {
                    startCamera(selectedCameraId);
                }
            });
        });

        function startCamera(cameraId) {
            html5QrCode = new Html5Qrcode("reader");
            html5QrCode.start(
                cameraId,
                { fps: 10, qrbox: 250 },
                onScanSuccess,
                error => console.warn("Error de escaneo:", error)
            ).catch(err => {
                console.error("Error al iniciar escaneo:", err);
            });
        }
    </script>

</body>

</html>