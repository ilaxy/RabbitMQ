<?php
class GoodReads
{
    
    const API_URL = 'https://www.goodreads.com';
   
    const CACHE_TTL = 3600;
   
    const SLEEP_BETWEEN_REQUESTS = 1000;
    
    protected $apiKey = 'vkocu8cqXPKDJc7wnPw';
    
    protected $cacheDir = 'cache';
    
    protected $lastRequestTime = 0;
    
    public function __construct($apiKey, $cacheDirectory = '')
    {
        $this->apiKey = (string)$apiKey;
        $this->cacheDir = (string)$cacheDirectory;
        $this->clearExpiredCache();
    }
    
    public function getAuthor($authorId)
    {
        return $this->request(
            'author/show',
            array(
                'key' => $this->apiKey,
                'id' => (int)$authorId
            )
        );
    }
    
    public function getBooksByAuthor($authorId, $page = 1)
    {
        return $this->request(
            'author/list',
            array(
                'key' => $this->apiKey,
                'id' => (int)$authorId,
                'page' => (int)$page
            )
        );
    }
    
    public function getBook($bookId)
    {
        return $this->request(
            'book/show',
            array(
                'key' => $this->apiKey,
                'id' => (int)$bookId
            )
        );
    }
   
    public function getBookByISBN($isbn)
    {
        return $this->request(
            'book/isbn/' . urlencode($isbn),
            array(
                'key' => $this->apiKey
            )
        );
    }
    /**
     * Get details for a given book by title.
     *
     * @param  string $title
     * @param  string $author Optionally provide this for more accuracy.
     * @return array
     */
    public function getBookByTitle($title, $author = '')
    {
        return $this->request(
            'book/title',
            array(
                'key' => $this->apiKey,
                'title' => urlencode($title),
                'author' => $author
            )
        );
    }
    /**
     * Get details for a given user.
     *
     * @param  integer $userId
     * @return array
     */
    public function getUser($userId)
    {
        return $this->request(
            'user/show',
            array(
                'key' => $this->apiKey,
                'id' => (int)$userId
            )
        );
    }
    
    public function getReview($reviewId, $page = 1)
    {
        return $this->request(
            'review/show',
            array(
                'key' => $this->apiKey,
                'id' => (int)$reviewId,
                'page' => (int)$page
            )
        );
    }
   
    public function getShelf($userId, $shelf, $sort = 'title', $limit = 100, $page = 1)
    {
        return $this->request(
            'review/list',
            array(
                'v' => 2,
                'format' => 'xml',     // :( GoodReads still doesn't support JSON for this endpoint
                'key' => $this->apiKey,
                'id' => (int)$userId,
                'shelf' => $shelf,
                'sort' => $sort,
                'page' => $page,
                'per_page' => $limit
            )
        );
