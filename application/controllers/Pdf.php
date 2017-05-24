<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pdfs extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->model('pdfs_model');
    }
    
    public function index()
    {
        //$data['provincias'] llena el select con las provincias españolas
        //$data['provincias'] = $this->pdfs_model->getProvincias();
		//$data["provincias"]["provincia"] = "a";
		//$data["provincias"]["id"] = "1";
		$data["provincias"][]=(object)array('provincia' => 'a', 'id'=>1);
		$data["provincias"][]=(object)array('provincia' => 'b', 'id'=>2);
		$data["provincias"][]=(object)array('provincia' => 'c', 'id'=>3);
		$data["provincias"][]=(object)array('provincia' => 'd', 'id'=>4);
		//cargamos la vista y pasamos el array $data['provincias'] para su uso
        $this->load->view('pdfs_view', $data);
    }

    public function generar() {
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Orshicell');
        $pdf->SetTitle('Remito');
        $pdf->SetSubject('Remito');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Reporte de ventas" . ' 001', "07/11/16", array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);

// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('freemono', '', 10, '', true);

// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

// Establecemos el contenido para imprimir
        $provincia = $this->input->post('provincia');
		$data["provincias"][]=array('p.provincia' => 'a', 'l.id'=>1, 'l.localidad'=>'aa1');
		$data["provincias"][]=array('p.provincia' => 'b', 'l.id'=>2, 'l.localidad'=>'aa2');
		$data["provincias"][]=array('p.provincia' => 'c', 'l.id'=>3, 'l.localidad'=>'aa3');
		$data["provincias"][]=array('p.provincia' => 'd', 'l.id'=>4, 'l.localidad'=>'aa4');
        $provincias = $data["provincias"];//$this->pdfs_model->getProvinciasSeleccionadas($provincia);
        foreach($provincias as $fila)
        {
            $prov = $fila['p.provincia'];
        }
        //preparamos y maquetamos el contenido a crear
        /*$html = '';
        $html .= "<style type=text/css>";
        $html .= "th{color: #fff; font-weight: bold; background-color: #222}";
        $html .= "td{background-color: #AAC7E3; color: #fff}";
        $html .= "</style>";
        $html .= "<h2>Listado de ventas".$prov."</h2><h4>Actualmente: ".count($provincias)." ventas</h4>";
        $html .= "<table width='100%'>";
        $html .= "<tr><th>Codigo de venta</th><th>Total</th></tr>";
        
        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
        foreach ($provincias as $fila) 
        {
            $id = $fila['l.id'];
            $localidad = $fila['l.localidad'];

            $html .= "<tr><td class='id'>" . $id . "</td><td class='localidad'>" . $localidad . "</td></tr>";
        }
        $html .= "</table>";
        */

        $this->load->model('venta_model','venta');
        $data['venta'] = $this->venta->get_by_id(5);
        $html=$this->load->view('factura_view',$data,TRUE);
        /*$pdf->Image(K_PATH_IMAGES.'zocalo_factura.jpg');
        $html='
        <table width="100%">
        <tr>
          <td width="50%" style="text-align: center;" valign="top"><span style="font-size: 50px">X</span><br/>No valido como factura</td>
          <td width="50%" valign="top" style="font-weight: bold;">
            <div> 
            <span>Remito Nro: '.$venta->id.'</span><br/>
            <span>'.$venta->fecha.'</span><br/>
            <span>Fecha de impresión</span> <span>'.date("Y-m-d H:i:s").'</span><br/>
            </div>
          </td>
        </tr>
      </table>
  </hr>
  <div class=""><span>Razón social:</span><span>'.$venta->cliente.'</span><br/>
    <span>Domicilio:</span><span>'.$venta->direccion.'</span><br/>
    <span>'.$venta->localidad.'</span><br/>
    <span>IVA:</span><span>Consumidor Final</span><br/>
    <span>Telefono:</span><span>$venta->tel_numero</span><br/>
    <span>Mail:</span><span>$venta->email</span><br/>  
  </div>
  </hr>
  <div>
    <table width="100%" class="renglones">
      <tr style="font-weight: bold;"><td>Código</td><td width="60%">Descripción</td><td>CANT</td><td>P.UNIT.</td><td>P.TOTAL</td></tr>
      <tr><td>S4</td><td>Modelo s4 samsung con doble chapa y led</td><td>5</td><td>$30</td><td>$150</td></tr>
      <tr><td>S4</td><td>Desc....</td><td>5</td><td>$30</td><td>$150</td></tr>
      <tr><td>S4</td><td>Desc....</td><td>5</td><td>$30</td><td>$150</td></tr>
      <tr><td>S4</td><td>Desc....</td><td>5</td><td>$30</td><td>$150</td></tr>
    </table>
  </div>
';
    $pdf->SetX(60);*/
// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Localidades de ".$prov.".pdf");
        $pdf->Output($nombre_archivo, 'I');
    }
}
?>