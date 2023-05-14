<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helper.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Base.php';

    class Report extends Base
    {
        function generateResponse(): array
        {
            if ($this->requestInfo->method === 'GET') {
                if ($this->requestInfo->path === '/getReport') {
                  //  return $this->getReport(); // 在 generateResponse 路徑條件下建議定義一個方法，讓這裡保持簡潔，除非只寫一行。方法名稱和建議和路徑名稱相同。
                }
            } else if ($this->requestInfo->method === 'POST') {
                $body = json_decode(file_get_contents('php://input'), true);
                if ($this->requestInfo->path === '/reportPost') {
                    return $this->reportPost($body);
                }
                if ($this->requestInfo->path === '/reportReply') {
                    return $this->reportReply($body);
                }
            }
            return $this->pathNotExistsFailInfo;
        }
        function reportPost(&$body): array
        {
            if ($this->userInfo->identity !== 'general') {
                return getGeneralFailInfo();
            }
            $postId = $body['post_id'];
            $report_category = $body['category'];
            $reason = $body['reason'];
            $identityId = $this->userInfo->identityId;
            query(
                "INSERT INTO report ( reporter, report_object, report_category, report_post, report_reply, reason, report_time, manager_id, deal_time, status)
                VALUES ($identityId, '貼文', '$report_category', '$postId', NULL, '$reason', NOW(), NULL, NULL, '待處理' );"
            );
            return getGeneralSuccessInfo();
        }
        function reportReply(&$body): array
        {
            if ($this->userInfo->identity !== 'general') {
                return getGeneralFailInfo();
            }
            $replyId = $body['reply_id'];
            $identityId = $this->userInfo->identityId;
            $report_category = $body['category'];
            $reason = $body['reason'];
            query(
                "INSERT INTO report ( reporter, report_object, report_category, report_post, report_reply, reason, report_time, manager_id, deal_time, status)
                VALUES ($identityId, '留言', '$report_category', NULL, '$replyId', '$reason', NOW(), NULL, NULL, '待處理' );"
            );
            return getGeneralSuccessInfo();
        }
    }
?>