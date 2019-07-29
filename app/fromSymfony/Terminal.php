<?php

namespace App\Http\Controllers;

class Terminal extends Controller
{
    public function endpoint()
    {
        $server = new Datto\JsonRpc\Server(new App\Services\JsonRpcCommand());
        $reply = $server->reply(request()->getContent());
        return response()->json(json_decode($reply));
    }

    public function doc(Request $request, $book = null)
    {
        $docDir = storage_path('docs');
        $hiddenBooks = [];

        // find all BOOKS (aka dirs)
        $files = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($docDir),
        \RecursiveIteratorIterator::SELF_FIRST);
        $books = [];
        $allBookName = [];
        foreach($files as $file) {
            if (is_dir($file) === true && basename($file) !== '.' && basename($file) !== '..') {
                $bookName      = str_replace($docDir . '/', '', $file);
                $bookName      = str_replace('/', '-', $bookName);
                $allBookName[] = $bookName;
                if (!in_array($bookName, $hiddenBooks)) {
                    $books[] = $bookName;
                }
            }
        }

        // get content choice BOOK
        if ($book && in_array($book, $allBookName)) {
            $book = str_replace('-', '/', $book);
            foreach(glob("$docDir/$book/*.md") as $section) {
                $text      = file_get_contents($section);
                $parsedown = new \Parsedown();
                $content   = $parsedown->text($text);
                $explodePath = explode('/', $section);
                $filename               = end($explodePath);
                $sectionName            = substr($filename, 0, -3); // remove .md !
                $sections[$sectionName] = $content;
            }
        }

        return view('main.doc', [
            'active4' => 'active',
            'books'    => json_encode($books),
            'sections' => (isset($sections)) ? $sections : null,
            'book'     => $request->query->get('bookName') ? : null
        ]);
    }
}
