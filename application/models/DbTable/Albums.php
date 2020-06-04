<?php

class Application_Model_DbTable_Albums extends Zend_Db_Table_Abstract
{

    protected $_name = 'albums';

    /**
     * albumのレコードを取得する
     *
     * @param [int] $id
     * @return void
     */
    public function getAlbum($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("IDが見つかりません");
        }
        return $row;
    }

    /**
     * albumにレコードを挿入する
     *
     * @param [string] $artist
     * @param [string] $title
     */
    public function addAlbum($artist, $title)
    {
        $data = array(
            'artist' => $artist,
            'title'  => $title
        );
        $this->insert($data);
    }

    /**
     * albumのレコードを更新する
     *
     * @param [int] $id
     * @param [string] $artist
     * @param [string] $title
     */
    public function updateAlbum($id, $artist, $title)
    {
        $data = array(
            'artist' => $artist,
            'title'  => $title
        );
        $this->update($data, 'id = ' . (int)$id);
    }

    /**
     * albumのレコードを削除する
     *
     * @param [int] $id
     */
    public function deleteAlbum($id)
    {
        $this->delete('id = ' . (int)$id);
    }
}

