<?php
class editorialComponents extends sfComponents
{
    public function executeMenuDisplay(sfWebRequest $request)
    {
      $this->displayClass = ($request->getParameter('action') == 'index')?'index':'';
    }
}