<?php

namespace App\Services;

use Datto\JsonRpc\Evaluator;

class JsonRpcCommand implements Evaluator
{
    private $help = [
        'login' => "login to the server (return token). Using:\nlogin [login] [password]",
        'soundtest' => 'Soundtest command',
        'whoami' => 'return user information',
        'ram' => 'check RAM memory usage',
        'imitation' => 'imitation of a typical human conversation from the standpoint computer\n
        The ideal solution for the Turing test',
        'bb' => 'Beavis & Butt-head ASCII'
    ];

    public function evaluate($method, $arguments)
    {
        // получаем список с автокомплитом
        if ($method === 'system.describe') {
            return [];
        }
        if (!method_exists(__CLASS__, $method)) {
            return 'Неизвестная команда';
        }

        return call_user_func_array([__CLASS__, $method], $arguments);
    }

    protected function add($terms)
    {
        return array_sum($terms);
    }

    protected function help($name = null)
    {
        if (in_array($name, array_keys($this->help))) {
            return $this->help[$name];
        }
        return implode("\n", array_keys($this->help));
    }

    protected function login($user = '', $passwd = '')
    {
        if (strcmp($user, 'noname') == 0 && strcmp($passwd, '1234') == 0) {
            return md5($user . ":" . $passwd);
        } else {
            return "Wrong Password. This is not the case, see 'help login'";
        }
    }

    protected function soundtest()
    {
        return '<audio controls><source src="sound/test.mp3" type="audio/mpeg"></audio>';
    }

    protected function whoami()
    {
        return "your User Agent : " . $_SERVER["HTTP_USER_AGENT"] .
            "\nyour IP : " . $_SERVER['REMOTE_ADDR'] .
            "\nyou access this from : " . $_SERVER["HTTP_REFERER"];
    }

    protected function ram()
    {
        return 'pRamPeak: ' . (memory_get_peak_usage(TRUE) >> 10) . 'kB curMemoryPeak: ' . (memory_get_peak_usage() >> 10) . "kB";
    }

    protected function imitation()
    {
        return "Bla Bla Bla! Bla-blabla bla-bla-bla\n
        bla bla bla bla bla bla\n
        Bla BLALBLABA babla!\n
        bla bla? bla blabla. Bla.";
    }

    protected function bb()
    {
        return <<<EOD
          ________________
         /                \
        / /          \ \   \
        |                  |
       /                  /
      |      ___\ \| | / /
      |      /          \
      |      |           \
     /       |      _    |
     |       |       \   |
     |       |       _\ /|     I am Corn Julio!!! I need TP for my
     |      __\     <_o)\o-    bunghole!!!! Where we come from we
     |     |             \     have no bungholes...Would you like
      \    ||             \    to be my bunghole?
       |   |__          _  \    /
       |   |           (*___)  /
       |   |       _     |    /
       |   |    //_______/
       |  /       | UUUUU__
        \|        \_nnnnnn_\-\
         |       ____________/
         |      /
         |_____/


                                      .-------------.
                                     /               \
                                    / .-----.         \
 I am the Great Cornholio!!         |/ --`-`-\         \
                                    |         \        |
 I need TP for my bunghole!!         |   _--   \       |
                                     _| =-.     |      |
 Come out with your pants down!      o|/o/      |      |
                                     /  ~       |      |
 ARE YOU THREATENING ME??          (____@)  ___ |      |
                                       _===~~~.`|      |
 Oh. heh-heh.  Sorry about that.   _______.--~  |      |
                                    \_______    |      |
 heh-heh.  This is cool.  heh-heh        |  \   |      |
                                          \_/__/       |
                                        /            __\
                                        -| Metallica|| |
                                        ||          || |
                                        ||          || |
                                        /|          / /

     ________________                            ______________
    /                \                          / /            \-___
   / /          \ \   \                         |     -    -         \
   |                  |                         | /         -   \  _  |
  /                  /                          \    /  /   //    __   \
 |      ___\ \| | / /                            \/ // // / ///  /      \
 |      /         \                              |             //\ __   |
 |      |           \                            \              ///     \
/       |      _    |                             \               //  \ |
|       |       \   |                              \   /--          //  |
|       |       _\ /|                               / (o-            / \|
|      __\     <_o)\o-                             /            __   /\ |
|     |             \                             /               )  /  |
 \    ||             \                           /   __          |/ / \ |
  |   |__          _  \                         (____ *)         -  |   |
  |   |           (*___)                            /               |   |
  |   |       _     |                               (____            |  |
  |   |    //_______/                                ####\           | |
  |  /       | UUUUU__                                ____/ )         |_/
   \|        \_nnnnnn_\-\                             (___             /
    |       ____________/                              \____          |
    |      /                                              \           |
    |_____/                                                \___________\
   /\/\/\/\/\/\/\/\/\                        /\/\/\/\/\/\/\/\/\/\/\/\/\
  /                  \                      /                          \
 <     B E A V I S    >          AND       <     B U T T - H E A D      >
  \                  /                      \                          /
   \/\/\/\/\/\/\/\/\/                        \/\/\/\/\/\/\/\/\/\/\/\/\/


AVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVIS
BEAVIS ________________BEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVI
SBEAV /                \ISASSWIPEBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISB
AVISB/ /          \ \   \EAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAV
ISBEA|                  |VISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVIS
BEAV/                  /BEAVISBEAVISBEAVISFARTKNOCKERSBEAVISBEAVISBEAV
ISB|      ___\ \| | / /ISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEA
VIS|      /          \VISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEA
BEA|      |           \BEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVI
VI/       |      _    |SBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAV
SB|       |       \   |
EA|       |       _\ /|     THESE ARE THOSE GUYS FROM MY DREAM!!
VI|      __\     <_o)\o-    THOSE ALIEN GUYS!! THEY LIKE COME INTO
SB|     |             \     MY ROOM WITH THIS SHINING WHITE LIGHT
EAV\    ||             \    AND THEY'VE GOT LIKE NADS ON THEIR
ISBE|   |__          _  \   HEADS AND THEN THEY LIKE TIE ME TO A
AVIS|   |           (*___)  CHAIR AND GET LIKE MEDIEVAL ON MY ASS!!
BEAV|   |       _     |    /
ISBE|   |    //_______/     BEAVISBEAVISBEAVISBEAVISBEAVISBEAVBUNGHOLE
AVIS|  /       | UUUUU__    BEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVIS
BEAVI\|        \_nnnnnn_\-\ BEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVIS
SBEAVI|       ____________/ BEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVIS
BEAVIS|      /BEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBEAVISBE
EOD;
    }
}
