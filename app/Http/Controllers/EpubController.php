<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Kiwilan\Ebook\Ebook;

class EpubController extends Controller
{

    protected $epubFiles = [
        'https://account.publishdrive.com/Books/Book1.epub',
        'https://account.publishdrive.com/Books/Book2.epub',
        'https://account.publishdrive.com/Books/Book3.epub',
        'https://account.publishdrive.com/Books/Book4.epub',

    ];

    protected $epubChacker;

    protected $currentBook;

    protected $currentBookPath = '';

    public function index()
    {

        return view('epub')->with(['files' => $this->epubFiles]);
    }

    public function processEbook($id)
    {
        $this->epubChacker = config('app.epub_checker');
        //dd($this->epubChacker);
        $this->currentBook = $id;
        $success = $this->downloadEpub($this->epubFiles[$this->currentBook]);
        if (!$success) {
            return redirect()->back()->with('error', 'Download Failes');
        }
        $this->writeEpub();
        return response()->download(public_path() . Storage::url('epub' . $this->currentBook + 1 . '.xml'));
    }

    protected function downloadEpub($fileUrl)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request("GET", $fileUrl);
        if (Storage::disk('public')->exists('tempbook.epub')) {
            Storage::disk('public')->delete('tempbook.epub');
        }

        if (!empty($response->getHeaders()['Content-Type'][0])) {
            Storage::disk('public')->put('tempbook.epub', $response->getBody()->getContents());
            $this->currentBookPath = Storage::path('tempbook.epub');
            return true;
        }
        return false;
    }

    protected function readEpub()
    {
        $ebook = Ebook::read($this->currentBookPath);

        return [
            'author' => $ebook->getAuthors()[0]->getName(),
            'title' => $ebook->getTitle(),
            'publisher' => $ebook->getPublisher(),
        ];
    }

    protected function writeEpub()
    {
        $metadata = $this->readEpub();
        $this->checkEpub();

        $output = View::make('epubXML')->with($metadata)->render();

        Storage::disk('public')->append('epub' . $this->currentBook + 1 . '.xml', $output);
    }

    protected function checkEpub()
    {
        if (Storage::disk('public')->exists("check.xml")) {
            Storage::disk('public')->delete("check.xml");
        }

        $result = Process::run("java -jar " . $this->epubChacker . DIRECTORY_SEPARATOR . "epubcheck.jar " . $this->currentBookPath . " --out " . public_path('storage') . DIRECTORY_SEPARATOR . "epub" . $this->currentBook + 1 . ".xml");
        return $result->output();
    }
}
