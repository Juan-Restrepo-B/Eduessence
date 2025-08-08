<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'phpqrcode/qrlib.php';

require('./fpdf.php');

class PDF extends FPDF
{

  // Cabecera de página
  function Header()
  {

    if (isset($_GET['idUser']) & isset($_GET['idCurso']) & isset($_GET['tipA'])) {
      $idCurso = $_GET['idCurso'];
      $asistente = $_GET['tipA'];
      $idUser = $_GET['idUser'];

       // Generate the QR code data
       $qrData = "http://eduessence.com/diploma?idUser=$idUser&tipA=$asistente&idCurso=$idCurso";

       // Generate a unique filename for the QR code image
       $qrFilename = uniqid('qr_', true) . '.png';

       // Path where the QR code image will be stored
       $dir = 'temp/' . $qrFilename;

       //Variables
       $tamaño = 10;
       $nivelCorreccion = 'M';
       $margin = 3;
       $contenido = $qrData;

       // Generate and save the QR code as an image
       QRcode::png($contenido, $dir, $nivelCorreccion, $tamaño, $margin);

      include 'conexion_bd.php';

      $consulta_reporte_alquiler = $conexion->query("SELECT PERSONA_NOMBRES,
            PERSONA_APELLIDOS, PERSONA_CORREO, PERSONA_DOCUMENTO,
            CARRERA_IDCURSO, DIPLOMA_TIPO_ASISTENTE, DIPLOMA_IMGDIPLOMA, CURSO_NOMBRE, IDCURSOS
            FROM TR_PERSONA tp
            INNER JOIN UN_CARRERA uc
            ON tp.PERSONA_CORREO = uc.CARRERA_USUARIO_NOMBRE
            INNER JOIN TR_DIPLOMAS td
            ON uc.CARRERA_IDCURSO = td.DIPLOMA_IDCURSO
            INNER JOIN TR_CURSOS tc 
            ON uc.CARRERA_IDCURSO = tc.IDCURSOS 
            WHERE PERSONA_CORREO = '$idUser'
            AND CARRERA_IDCURSO = '$idCurso'
            AND DIPLOMA_TIPO_ASISTENTE = '$asistente'");

      $datos_reporte = $consulta_reporte_alquiler->fetch_object();
      if ($datos_reporte !== null) {
        $this->Image('img/' . $datos_reporte->DIPLOMA_IMGDIPLOMA, 0, 0, 297); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
        $this->SetFont('Arial', 'B', 29); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto


        $this->Image('temp/' . $qrFilename, 10.5, 178, 28); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG

        if($datos_reporte->IDCURSOS == 6 || $datos_reporte->IDCURSOS == 4 || $datos_reporte->IDCURSOS == 5){
          $this->Ln(87); // Salto de línea
          $this->Cell(83); // Movernos a la derecha
          $this->SetTextColor(0, 0, 0); //color
          //creamos una celda o fila
          $this->Cell(100, 0, mb_convert_encoding($datos_reporte->PERSONA_NOMBRES . " " . $datos_reporte->PERSONA_APELLIDOS, 'ISO-8859-1', 'UTF-8'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
          $this->Ln(3); // Salto de línea
          $this->SetTextColor(103); //color

          /* ID */
          $this->Cell(115); // mover a la derecha
          $this->SetFont('Arial', 'B', 15);
          $this->Cell(185, 10, mb_convert_encoding("ID: " . $datos_reporte->PERSONA_DOCUMENTO, 'ISO-8859-1', 'UTF-8'), 0, 0, '', 0);
          $this->Ln(10);
        } else {
          $this->Ln(72); // Salto de línea
          $this->Cell(83); // Movernos a la derecha
          $this->SetTextColor(0, 0, 0); //color
          //creamos una celda o fila
          $this->Cell(100, 0, mb_convert_encoding($datos_reporte->PERSONA_NOMBRES . " " . $datos_reporte->PERSONA_APELLIDOS, 'ISO-8859-1', 'UTF-8'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
          $this->Ln(3); // Salto de línea
          $this->SetTextColor(103); //color

          /* ID */
          $this->Cell(115); // mover a la derecha
          $this->SetFont('Arial', 'B', 15);
          $this->Cell(85, 10, mb_convert_encoding("ID: " . $datos_reporte->PERSONA_DOCUMENTO, 'ISO-8859-1', 'UTF-8'), 0, 0, '', 0);
          $this->Ln(10);
        }
      } else {
        echo "No se encontraron resultados para el ID proporcionado.";
        echo "idUser: " . $_GET['idUser']; // Mensaje de depuración 
      }
    }
  }

  // Pie de página
  function Footer()
  {
  }
}


$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas
if (isset($_GET['idCurso'])) {
  $idCurso = $_GET['idCurso'];

  include 'conexion_bd.php';

  $consulta_reporte_alquiler = $conexion->query("SELECT CURSO_NOMBRE
        FROM  TR_CURSOS tc 
        WHERE IDCURSOS = '$idCurso'");

  $datos_reporte = $consulta_reporte_alquiler->fetch_object();
  if ($datos_reporte) {
    $pdf->Output('Certificado_' . $datos_reporte->CURSO_NOMBRE . '.pdf', 'D'); //nombreDescarga, Visor(I->visualizar - D->descargar)
  }
}