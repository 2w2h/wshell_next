<?php
if (!$user->isAdmin()) header('Location: /');

$template = $wshell->twig()->loadTemplate($wshell->action . '.twig');
echo $template->render(array('user' => $user, 'active5' => 'active'));