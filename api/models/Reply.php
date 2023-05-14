<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Base.php';

class Reply extends Base
{
    function generateResponse(): array
    {
        if ($this->requestInfo->method === 'GET') {
            if ($this->requestInfo->path === '/getReplysByPostId') {
                return $this->getReplysByPostId(); // 在 generateResponse 路徑條件下建議定義一個方法，讓這裡保持簡潔，除非只寫一行。方法名稱和建議和路徑名稱相同。
            }
        } else if ($this->requestInfo->method === 'POST') {
            $body = json_decode(file_get_contents('php://input'), true);
            if ($this->requestInfo->path === '/addReply') {
                return $this->addReply($body);
            }
            if ($this->requestInfo->path === '/addHeart') {
                return $this->addHeart($body);
            }
            if ($this->requestInfo->path === '/deleteHeart') {
                return $this->deleteHeart($body);
            }
        }
        return $this->pathNotExistsFailInfo;
    }


    //   function getReplys(): array
    //   {
    //      $identity = $this->userInfo->identity;
    //      $identityId = $this->userInfo->identityId;
    //      $postId = $this->requestInfo->queries['post_id'];

    //      if ($identity !== 'general') {
    //          return [];
    //      }

    //      $sql = "SELECT r.context, r.reply_time, r.replier FROM reply r WHERE r.post_id = $postId";
    //     return query($sql);
    // }

    function getReplysByPostId(): array
    {
        $postId = $this->requestInfo->queries['post_id'];

        return query(
            "SELECT r.context, gu.nickname, r.replier, r.reply_time, gu.subject, r.reply_id
            FROM reply r
            JOIN general_user gu ON r.replier = gu.general_id
            WHERE r.post_id = '$postId'
            ORDER BY r.reply_time DESC;"
        );
    }

    function addReply(&$body): array
    {
        if ($this->userInfo->identity !== 'general') {
            return getGeneralFailInfo();
        }
        $postId = $body['post_id'];
        $identityId = $this->userInfo->identityId;
        $context = $body['context'];
        query(
            "INSERT INTO reply ( replier, post_id, context, reply_time )
            VALUES ('$identityId', '$postId', '$context', NOW() );"
        );
        return getGeneralSuccessInfo();
    }
    function addHeart(&$body): array
    {
        if ($this->userInfo->identity !== 'general') {
            return getGeneralFailInfo();
        }
        $replyId = $body['reply_id'];
        $identityId = $this->userInfo->identityId;
        query(
            "INSERT INTO heart ( send_user, post_id, reply_id, time )
            VALUES ($identityId, NULL, '$replyId', NOW() );"
        );
        return getGeneralSuccessInfo();
    }
    function deleteHeart(&$body): array
    {
        if ($this->userInfo->identity !== 'general') {
            return getGeneralFailInfo();
        }
        $replyId = $body['reply_id'];
        $identityId = $this->userInfo->identityId;
        query(
            "DELETE FROM heart WHERE send_user = '$identityId' AND reply_id = '$replyId';"
        );
        return getGeneralSuccessInfo();
    }
    function checkSelfHeart($replyId): bool
    {
        $identityId = $this->userInfo->identityId;
        $rs = query("SELECT * FROM heart WHERE reply_id = '$replyId' and send_user = '$identityId'");
        return sizeof($rs) > 0;
    }

}
?>