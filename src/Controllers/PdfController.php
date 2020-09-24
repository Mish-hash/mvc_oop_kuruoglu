<?php


namespace Controllers;

use View\View;
use Models\Post;
use Models\User;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
class PdfController
{
    public function index()
    {
        $mpdf = new \Mpdf\Mpdf();
//        $text= file_get_contents('src/routes.php');
        $users = User::all();
        $text = '<h1>Users</h1>';
//        $text .= '<table border="1">';
//        foreach ($users as $user) {
//            $text .='<tr>';
//            $text .= '<td>' . $user->getName() . '</td>';
//            $text .= '<td>' . $user->getEmail() . '</td>';
//            $text .= '</tr>';
//            $mpdf->AddPage();
//
//        }
//        $text .= '</table>';
        $stylesheet = file_get_contents('css/style.css');
        $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($text ,\Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->setFooter("{PAGENO} из {nbpg}");
       foreach ($users as $user) {
           $mpdf->AddPage();



           $mpdf->WriteHTML($user->getName());
       }
//        $mpdf->WriteHTML('<pre>' . $text . '</pre>');
        $mpdf->Output('test.pdf' , 'D');
    }

    public function excelExport()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $posts = Post::all();
        $i = 0;
        foreach ($posts as $post) {
        $i++;
        $sheet->setCellValue('A' . $i, $post->getName());
        $sheet->setCellValue('B' . $i, $post->getText());
        $sheet->setCellValue('C' . $i, $post->getAuthor()->getName());
        }

        $writer = new Xlsx($spreadsheet);
//        $writer->save('hello world.xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"hello.xlsx\"");
        $writer->save('php://output');
        exit();
    }

    public function excelImport()
    {
        $tmp_path = $_FILES['userfile']['tmp_name'];
        $fileName = $_FILES['userfile']['name'];
        $uploaddir =  './src/loadFile/';
        echo $uploaddir . '<br>';
        $uploadfile = $uploaddir . $fileName;
        echo $uploadfile;
        move_uploaded_file($tmp_path, $uploadfile);


        $pars = IOFactory::load($uploadfile);
        '<pre>' . var_dump($pars) . '</pre>';
//        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
//        $spreadsheet = $reader->load($uploadfile);
        print_r($_FILES);





            View::render('home/import');

    }
}