<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Profile Controller
 *
 * @property \App\Model\Table\ProfileTable $Profile
 *
 * @method \App\Model\Entity\Profile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProfileController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {   
        $profile = $this->Profile->find('all', [
            'conditions' => ['user_id' => $this->Auth->user('id')]
        ]);

        
        /*$this->paginate = [
            'conditions' => ['user_id'  => $this->Auth->user('id')]
        ];*/
        //$profile = $this->paginate($this->Profile);
        //debug($profile);
        //$this->set(compact('profile'));
        $this->set([
            'profile' => $profile,
            '_serialize' => ['profile']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $profile = $this->Profile->get($id, [
            'contain' => ['Users']
        ]);


        $this->set([
            'profile' => $profile,
            '_serialize' => ['profile']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $profile = $this->Profile->newEntity();
        if ($this->request->is('post')) {
            $profile = $this->Profile->patchEntity($profile, $this->request->getData());
            if ($this->Profile->save($profile)) {
                $this->Flash->success(__('The profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profile could not be saved. Please, try again.'));
        }
        $users = $this->Profile->Users->find('list', ['limit' => 200]);
        $this->set(compact('profile', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
        $this->loadModel("Photos");
        $profile = $this->Profile->find('all', [
            'conditions' => ['user_id' => $this->Auth->user('id')]
        ]);

        $profile = $this->Profile->get($profile->first()->id, [
            "contains" => ['Users', 'Photos']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $profile = $this->Profile->patchEntity($profile, $this->request->getData());
            if ($this->Profile->save($profile)) {
                $this->Flash->success(__('The profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profile could not be saved. Please, try again.'));
        }
        //$users = $this->Profile->Users->find('list', ['limit' => 200]);
        $photo = $this->Photos->get($profile->photo_id);
        
        $this->set([
            'profile' => $profile,
            'profile_photo' => $photo,
            '_serialize' => ['profile', 'profile_photo']
        ]);
    }

    public function uploadprofilephoto() {
        $this->loadModel("Photos");
        if ($this->request->is('post')) {
            $rData = $this->request->getData();
            if (move_uploaded_file($rData['url']['tmp_name'], WWW_ROOT . "img/users/".$rData['url']['name'])) {
                

                $userProfileId = $this->Profile->find("all", [
                    "conditions" => ["user_id" => $this->Auth->user('id')]
                ])->first()->id;

                $userProfile = $this->Profile->get($userProfileId, [
                    "contains" => ["Users"]
                ]);

                $photo = $this->Photos->get($userProfile->photo_id);

                $photo->url = "img/users/".$rData['url']['name'];
                $photo->user_id = $this->Auth->user('id');

                
                $userProfile->photo = $photo;

                $this->Profile->save($userProfile);
            }
            
        }

        $this->set([
            'test' => ['Hello'],
            'data' => $this->request->getData(),
            'newPhoto' => $newPhoto,
            '_serialize' => ['data', 'test']
        ]);
        

    }

    /**
     * Delete method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $profile = $this->Profile->get($id);
        if ($this->Profile->delete($profile)) {
            $this->Flash->success(__('The profile has been deleted.'));
        } else {
            $this->Flash->error(__('The profile could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
