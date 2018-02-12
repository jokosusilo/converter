<?php

use mikehaertl\wkhtmlto\Pdf;

class Converter
{
    private $config;
    private $mustache;
    private $wkPdf;

    public function __construct($config)
    {
        $this->config   = $config;
        $this->mustache = new Mustache_Engine;
        $this->wkPdf    = new Pdf();
    }

    private function getTemplate($filename)
    {
        return file_get_contents($this->config['templateDir'].'/'.$filename);
    }

    private function getHtmlContent($file)
    {
        if (!is_array($file)) {
            $file = json_decode(file_get_contents($this->config['dataDir'].'/'.$file), true);
        }

        $data = array_merge($file,
            [
                'base_url' => $this->config['base_url'],
            ]
        );

        return $data;
    }

    private function writeHtml($file, $content)
    {
        $handle = fopen($this->config['resultDir'].'/html/'.$file, 'w') or die('Cannot open file:  '.$this->config['dataDir'].'/html/'.$file);
        fwrite($handle, $content);
        fclose($handle);
    }
	
	private function convert($type, $template, $data)
    {
        $data       = $this->getHtmlContent($data);
        $filename   = $template;

        $content = $this->mustache->render($this->getTemplate($template), $data);
        $this->writeHtml($filename, $content);

        $contentHtml = file_get_contents($this->config['resultDir'].'/html/'.$filename);

        if ($type == 'html') {
            echo $contentHtml;
        }elseif ($type == 'pdf') {
            $this->wkPdf->binary = "C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe";
            $this->wkPdf->addPage($contentHtml);
            $this->wkPdf->send();
        }
    }

    public function asHtml($template, $data)
    {
        $this->convert('html', $template, $data);
    }

    public function asPdf($template, $data)
    {
        $this->convert('pdf', $template, $data);
    }
}