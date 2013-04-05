<?php

class ThreadsController extends HController
{
    const MESSAGES_PER_PAGE = 20;

    public function filters()
    {
        return array(
//            'ajaxOnly',
//            'postOnly',
        );
    }

    /**
     * Создание диалога
     *
     * Создает новый диалог с указанным собеседником
     */
    public function actionCreate()
    {
        $interlocutor_id = Yii::app()->request->getPost('interlocutor_id');

        $thread = new MessagingThread();
        $threadUser1 = new MessagingThreadUser();
        $threadUser1->user_id = Yii::app()->user->id;
        $threadUser2 = new MessagingThreadUser();
        $threadUser2->user_id = $interlocutor_id;
        $thread->threadUsers = array($threadUser1, $threadUser2);

        $success = $thread->withRelated->save(true, array('threadUsers'));
        $response = array(
            'success' => $success,
        );
        echo CJSON::encode($response);
    }

    /**
     * Изменяет статус видимости диалога
     *
     * @throws CHttpException
     */
    public function actionChangeHiddenStatus()
    {
        $threadId = Yii::app()->request->getPost('threadId');
        $hiddenStatus = Yii::app()->request->getPost('hiddenStatus');

        $threadUser = MessagingThreadUser::model()->findByAttributes(array(
            'thread_id' => $threadId,
            'user_id' => Yii::app()->user->id,
        ));

        if ($threadUser === null)
            throw new CHttpException(403, 'Thread does not exists.');

        $threadUser->hidden = $hiddenStatus;

        $success = $threadUser->save();
        $response = array(
            'success' => $success,
        );
        echo CJSON::encode($response);
    }

    /**
     * Изменяет статус прочитанности диалога
     */
    public function actionChangeReadStatus()
    {
        $threadId = Yii::app()->request->getPost('threadId');
        $readStatus = Yii::app()->request->getPost('readStatus');


        $thread = MessagingThread::model();
        $thread->id = $threadId;
        if ($readStatus == 1)
            $thread->markAsReadFor(Yii::app()->user->id);
        else
            $thread->markAsUnReadFor(Yii::app()->user->id);

        $response = array(
            'success' => true,
        );
        echo CJSON::encode($response);
    }

    /**
     * Подгружает выбранный диалог
     *
     * @param $threadId
     * @param int $offset
     * @param bool $withInterlocutor
     * @param null $interlocutorId
     */
    public function actionGet($threadId, $offset = 0, $withInterlocutor = false, $interlocutorId = null)
    {
        $thread = MessagingThread::model();
        $thread->id = $threadId;

        $messages = $thread->getMessages(self::MESSAGES_PER_PAGE, $offset);

        $data = compact('messages');

        if ($withInterlocutor !== false) {
            if ($interlocutorId === null)
                $interlocutorId = $thread->getInterlocutorIdFor(Yii::app()->user->id);
            $interlocutorModel = User::model()->with('avatar')->findByPk($interlocutorId);

            $interlocutor = array(
                'id' => (int) $interlocutorModel->id,
                'firstName' => $interlocutorModel->first_name,
                'lastName' => $interlocutorModel->last_name,
                'online' => (bool) $interlocutorModel->online,
                'avatar' => $interlocutorModel->getAva(),
                'blogPostsCount' => (int) $interlocutorModel->blogPostsCount,
                'photosCount' => (int) $interlocutorModel->photosCount,
                'isFriend' => (bool) $interlocutorModel->isFriend(Yii::app()->user->id),
            );

            $data['interlocutor'] = $interlocutor;
        }

        $data = CJSON::encode($data);

        $this->render('/default/index', compact('data'));
    }
}