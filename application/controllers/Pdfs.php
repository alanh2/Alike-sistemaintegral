<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pdfs extends MY_Controller {

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
    public function imprimir_lista_precios(){
        $this->isAdmin();
        ini_set('max_execution_time', 1200);
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Orshicell');
        $pdf->SetTitle('Cuenta Corriente');
        $pdf->SetSubject('Cuenta Corriente');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(false);
        $pdf->SetFont('freemono', '', 10, '', true);
        $this->load->helper('url');
        $this->load->model('producto_model','producto');
        $lp = $this->producto->get_lista_precios();
        $renglones=count($lp);
        $max_cant=30;
        $paginas=ceil($renglones/$max_cant);
        $html="";
        //for($pagina=0;$pagina<$paginas;$pagina++){
            $pdf->AddPage();
            $html.= "<table class='renglones' border='1'>";
            for($i=0;$i<$renglones;$i++){
                //$html=$lp[$i];
                //print_r($lp[$i]);
                $html.= "<tr><td>".$lp[$i]->id."</td>";
                $html.= "<td>".$lp[$i]->marca."</td>";
                $html.= "<td>".$lp[$i]->modelo."</td>";
                $html.= "<td>".$lp[$i]->subcategoria."</td>";
                $html.= "<td>".$lp[$i]->producto."</td>";
                $html.= "<td>".$lp[$i]->color."</td>";
                $html.= "<td>".$lp[$i]->cantidad."</td>";
                $html.= "<td>".$lp[$i]->l1."</td>";
                $html.= "<td>".$lp[$i]->l2."</td>";
                $html.= "<td>".$lp[$i]->l3."</td>";
                $html.= "<td>".$lp[$i]->l4."</td></tr>";
            }
            $html.= "</table>";
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 0, $fill = 0, $reseth = true, $align = '', $autopadding = true);
                echo $html;
            $nombre_archivo = utf8_decode("test.pdf");
                $pdf->Output($nombre_archivo, 'I');
      
        //}

    }
    
    public function lista_precios($lista=null){
        $this->isAdmin();
        $this->load->helper('url');
        $data['view']='producto_lista_precios_view';
        $data['data']['stock'] = $this->producto->get_lista_precios($lista);
        $data['data']['lista'] = $lista;
        $this->load->view('master_view',$data);
        //echo $this->db->last_query();

    }
    public function imprimir_cuenta_corriente($clienteid) {
        $this->isAdmin();
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Orshicell');
        $pdf->SetTitle('Cuenta Corriente');
        $pdf->SetSubject('Cuenta Corriente');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(false);
        $pdf->AddPage();
        $this->load->helper('url');
        $this->load->model('cliente_model','cliente');
        $this->load->model('venta_model','venta');
        $this->load->model('cobro_model','cobro');
        $this->load->model('notacredito_model','notacredito');
        $notasCredito = $this->notacredito->get_resumen_by_clienteid($clienteid);
        $ventas = $this->venta->get_resumen_by_clienteid($clienteid);
        $cobros = $this->cobro->get_resumen_by_clienteid($clienteid);
        $cliente = $this->cliente->get_by_id($clienteid);

        $data['data']['movimientos'] = array_merge($ventas,$notasCredito, $cobros);
        
        function cmp($a, $b)
        {
            return strcmp($a->fecha, $b->fecha);
        }

        usort($data['data']['movimientos'],  "cmp");
        $data['data']['cliente'] = $cliente;
        $html=$this->load->view('cliente_cuenta_pdf_view',$data,TRUE);
       
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 0, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode($clienteid."_cc.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

    public function imprimir_venta($ventaid) {
        $this->isAdmin();
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Orshicell');
        $pdf->SetTitle('Remito');
        $pdf->SetSubject('Remito');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(false);
        $pdf->AddPage();
        $this->load->model('venta_model','venta');
        $this->load->model('venta_renglones_model','venta_renglones');
        $this->load->model('aplicacioncobroventa_model','aplicacionCobroVenta');
        $data['venta'] = $this->venta->get_by_id($ventaid);
        $data['venta_renglones'] = $this->venta_renglones->get_by_venta($ventaid);
        $data['venta_cobros'] = $this->aplicacionCobroVenta->get_by_venta_id($ventaid);
        $html=$this->load->view('factura_view',$data,TRUE);
       
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 0, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $nombre_archivo = utf8_decode($ventaid.".pdf");
        $pdf->Output($nombre_archivo, 'I');
        //$html=$this->load->view('factura_view',$data);
    }
    public function imprimir_venta_salvacell($ventaid) {
        $this->isAdmin();
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Orshicell');
        $pdf->SetTitle('Remito');
        $pdf->SetSubject('Remito');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(false);
        $pdf->AddPage();
        $this->load->model('venta_model','venta');
        $this->load->model('venta_renglones_model','venta_renglones');
        $this->load->model('aplicacioncobroventa_model','aplicacionCobroVenta');
        $data['venta'] = $this->venta->get_by_id($ventaid);
        $data['venta_renglones'] = $this->venta_renglones->get_by_venta($ventaid);
        $data['venta_cobros'] = $this->aplicacionCobroVenta->get_by_venta_id($ventaid);
        $html=$this->load->view('factura_salvacell_view',$data,TRUE);
       
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 0, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $nombre_archivo = utf8_decode($ventaid.".pdf");
        $pdf->Output($nombre_archivo, 'I');
        //$html=$this->load->view('factura_view',$data);
    }
}
?>