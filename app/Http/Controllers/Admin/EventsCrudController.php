<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Storage;

/**
 * Class EventsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EventsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Events::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/events');
        CRUD::setEntityNameStrings('events', 'events');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

        //add column for image
        

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(EventsRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
        //add select for location
        CRUD::addField([
            'name' => 'location_id',
            'label' => 'Location',
            'type' => 'select',
            'entity' => 'location',
            'attribute' => 'name',
            'model' => "App\Models\Locations",
        ]);

        //add automatic user insert
        CRUD::addField([
            'name' => 'user_id',
            'label' => 'User',
            'type' => 'hidden',
            'default' => backpack_user()->id,
        ]);

        //create IsActive as true or false
        CRUD::addField([
            'name' => 'isActive',
            'label' => 'Is Active',
            'type' => 'checkbox',
            'default' => 1,
        ]);

        //create image upload
        CRUD::addField([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
        ]);

        

    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

     public function store()
    {
        $event = new \App\Models\Events;
        $this->crud->setRequest($this->crud->validateRequest());
        $event->fill(request()->input())->save();

        $this->handleImageUpload($event);

        return redirect('admin/events');
    }

    public function update()
    {
        $event = \App\Models\Events::findOrFail($this->crud->getCurrentEntryId());
        $this->crud->setRequest($this->crud->validateRequest());
        $event->fill(request()->input())->save();

        $this->handleImageUpload($event);

        return redirect('admin/events');
    }

    private function handleImageUpload($event)
    {
        if (request()->hasFile('image')) {
            $filename = request()->file('image')->store('uploads', 'public');
            $event->image = $filename;
            $event->save();
        }
    }
}
