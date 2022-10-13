<?php

namespace KnowledgeCity;

class Pagination
{
    private int $page;
    private int $perPage;
    private int $total;
    private int $lastPage;
    private int $prevPage;
    private int $nextPage;
    private string $baseUrl;

    /**
     * @param int $page
     * @param int $perPage
     * @param int $total
     * @param string $baseUrl
     */
    public function __construct(int $page, int $perPage, int $total, string $baseUrl = '') {
        $this->setPage($page);
        $this->setPerPage($perPage);
        $this->setTotal($total);
        $this->setBaseUrl($baseUrl);
        $this->setLastPage(ceil($total / $perPage));
        $this->setPrevPage($this->getPage() === 1 ? false : $this->getPage() - 1);
        $this->setNextPage($this->getPage() === $this->getLastPage() ? false : $this->getPage() + 1);
    }

    /**
     * @return int
     */
    public function getPage(): int {
        return $this->page;
    }

    /**
     * @param int $page
     * @return void
     */
    public function setPage(int $page): void {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getLastPage(): int {
        return $this->lastPage;
    }

    /**
     * @param int $lastPage
     */
    public function setLastPage(int $lastPage): void {
        $this->lastPage = $lastPage;
    }

    /**
     * @return array
     */
    public function getPaginationParams(): array {
        $res = [];
        $res['first_page_url'] = $this->getFirstPageUrl();
        $res['last_page_url'] = $this->getLastPageUrl();
        $res['prev_page_url'] = $this->getPrevPageUrl();
        $res['next_page_url'] = $this->getNextPageUrl();
        $res['current_page_url'] = $this->getCurrentPageUrl();
        return $res;
    }

    /**
     * @return string
     */
    public function getFirstPageUrl(): string {
        return $this->getBaseUrl() . '?page=1';
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     */
    public function setBaseUrl(string $baseUrl): void {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return string
     */
    public function getLastPageUrl(): string {
        return $this->getBaseUrl() . '?page=' . $this->getLastPage();
    }

    /**
     * @return string
     */
    private function getPrevPageUrl(): string {
        return $this->getPrevPage() ? $this->getBaseUrl() . '?page=' . $this->getPrevPage() : '';
    }

    /**
     * @return int|false
     */
    public function getPrevPage(): int|false {
        return $this->prevPage;
    }

    /**
     * @param int|false $prevPage
     */
    public function setPrevPage(int|false $prevPage): void {
        $this->prevPage = $prevPage;
    }

    /**
     * @return string
     */
    private function getNextPageUrl(): string {
        return $this->getNextPage() ? $this->getBaseUrl() . '?page=' . $this->getNextPage() : '';
    }

    /**
     * @return int|false
     */
    public function getNextPage(): int|false {
        return $this->nextPage;
    }

    /**
     * @param int|false $nextPage
     */
    public function setNextPage(int|false $nextPage): void {
        $this->nextPage = $nextPage;
    }

    private function getCurrentPageUrl() {
        return $this->getBaseUrl() . '?page=' . $this->getPage();
    }

    /**
     * @return int
     */
    public function getPerPage(): int {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     */
    public function setPerPage(int $perPage): void {
        $this->perPage = $perPage;
    }

    /**
     * @return int
     */
    public function getTotal(): int {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total): void {
        $this->total = $total;
    }


}