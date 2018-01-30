<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Date Controller
 *
 *
 * @method \App\Model\Entity\Date[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DateController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $this->paginate = [
            'conditions' => ['user_id' => $this->Auth->user('id')]
        ];
        
        $date = $this->paginate($this->Date);
        //debug($date);

          $this->set([
            'date' => $date,
            '_serialize' => ['date']
          ]);
        //$this->set(compact('filteredDate'));
    }

    /**
     * View method
     *
     * @param string|null $id Date id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $date = $this->Date->get($id, [
            'contain' => []
        ]);
        
        debug($date);
        $this->set('date', $date);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $date = $this->Date->newEntity();
        if ($this->request->is('post')) {
            $date = $this->Date->patchEntity($date, $this->request->getData());
            if ($this->Date->save($date)) {
                $this->Flash->success(__('The date has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The date could not be saved. Please, try again.'));
        }
        $this->set(compact('date'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Date id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $date = $this->Date->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $date = $this->Date->patchEntity($date, $this->request->getData());
            if ($this->Date->save($date)) {
                $this->Flash->success(__('The date has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The date could not be saved. Please, try again.'));
        }
        $this->set([
            'date' => $date,
            '_serialize' => 'date'
        ]);
    }

    public function setStatus($id = null)
    {
        $date = $this->Date->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']) && $this->request->getData()["status"]) {
            $date = $this->Date->patchEntity($date, $this->request->getData());
            $date->status = $this->request->getData()["status"];
            if ($this->Date->save($date)) {
                $this->Flash->success(__('La reserva ha sido aceptada.'));
            }
            $this->Flash->error(__('La reserva no pudo ser aceptada, intentelo denuevo.'));
        }
        $this->set([
            'data' => $data,
            'date' => $date,
            '_serialize' => ['data', 'date']
        ]);
    }


    /**
     * Delete method
     *
     * @param string|null $id Date id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $date = $this->Date->get($id);
        if ($this->Date->delete($date)) {
            $this->Flash->success(__('The date has been deleted.'));
        } else {
            $this->Flash->error(__('The date could not be deleted. Please, try again.'));
        }

        $this->set([
            'date' => $date,
            '_serialize' => 'date'
        ]);
    }
}
