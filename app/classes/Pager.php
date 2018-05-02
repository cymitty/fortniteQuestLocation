<?php

namespace StudentList;


class Pager
{
  private $totalRecords;
  private $recordsPerPage;
  private $linkPattern;

  public function __construct($totalRecords, $recordsPerPage, $linkPattern)
  {
    $this->totalRecords = $totalRecords;
    $this->recordsPerPage = $recordsPerPage;
    $this->linkPattern = $linkPattern;
  }

  public function getTotalPages()
  {

    return $this->totalRecords / $this->recordsPerPage;
  }

  public function getLinkForPage($pageNumber)
  {
    $result = str_replace("{page}", $pageNumber, $this->linkPattern);
    return $result;
  }

  public function getLinkForLastPage()
  {
    $result = str_replace("{page}", $this->totalRecords, $this->linkPattern);
    return $result;
  }

  public function build()
  {
    $links = array();
    $totalPages = $this->getTotalPages();
    for ($i = 1; $i <= $totalPages; $i++) {
      $links[$i] = $this->getLinkForPage($i);
    }

    return $links;
  }
}