<?php namespace Metin2CMS\Services;

use Metin2CMS\Repositories\HistoryRepositoryInterface;

class HistoryService {
    /**
     * @var HistoryRepositoryInterface
     */
    private $history;

    /**
     * @param HistoryRepositoryInterface $history
     */
    public function __construct(HistoryRepositoryInterface $history)
    {
        $this->history = $history;
    }

    /**
     * Creates a history entry for a user
     *
     * @param $account
     * @param $type
     * @param string $data
     * @return mixed
     */
    public function create($account, $type, $data = '')
    {
        return $this->history->create(array(
            'account' => $account,
            'event'   => $type,
            'data'    => $data,
        ));
    }

    /**
     * Find history events by account id
     *
     * @param $account
     * @return mixed
     */
    public function find($account)
    {
        return $this->history->findByAccount($account);
    }
}