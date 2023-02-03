<?php

namespace DMO\SavingsBond\Controllers\Models;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;
use Hasob\FoundationCore\Models\User;

use DMO\SavingsBond\Requests\CreateInvestorRequest;
use DMO\SavingsBond\Requests\UpdateInvestorRequest;
use DMO\SavingsBond\DataTables\InvestorDataTable;

use DMO\SavingsBond\Models\Investor;
use DMO\SavingsBond\Events\InvestorCreated;
use DMO\SavingsBond\Events\InvestorUpdated;
use DMO\SavingsBond\Events\InvestorDeleted;
use DMO\SavingsBond\Models\Broker;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvestorController extends BaseController
{
    /**
     * Display a listing of the Investor.
     *
     * @param InvestorDataTable $investorDataTable
     * @return Response
     */
    public function index(Organization $org, InvestorDataTable $investorDataTable)
    {
        $current_user = Auth()->user();
        $users = [""=>""];
        $brokers =[""=>""];

        // clean sort and merge users by name
        foreach (User::all()->sortBy('first_name') as $key => $user) {
            // exclude current user
            if($current_user == $user)
            continue;
             // exclude user already registered as investor
             if(Investor::find($user->id))
             continue;
            $users = array_merge($users, [$user->id => $user->first_name]);
        }

        // sort and merge brokers by full name
        foreach (Broker::all()->sortBy('broker_code') as $key => $broker) {
            $brokers = array_merge($brokers, [$broker->id => $broker->broker_code]);
        }


        $cdv_investors = new \Hasob\FoundationCore\View\Components\CardDataView(Investor::class, "dmo-savings-bond-module::pages.investors.card_view_item");
        $cdv_investors->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search Investor');

        if (request()->expectsJson()){
            return $cdv_investors->render();
        }

        return view('dmo-savings-bond-module::pages.investors.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('users', $users)
                    ->with('brokers', $brokers)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_investors', $cdv_investors);

        /*
        return $investorDataTable->render('dmo-savings-bond-module::pages.investors.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new Investor.
     *
     * @return Response
     */
    public function create()
    {
        return view('dmo-savings-bond-module::pages.investors.create');
    }

    /**
     * Store a newly created Investor in storage.
     *
     * @param CreateInvestorRequest $request
     *
     * @return Response
     */
    public function store(CreateInvestorRequest $request)
    {
        $input = $request->all();

        /** @var Investor $investor */
        $investor = Investor::create($input);

        //Flash::success('Investor saved successfully.');

        InvestorCreated::dispatch($investor);
        return redirect(route('sb.investors.index'));
    }

    /**
     * Display the specified Investor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Organization $org, $id)
    {
        /** @var Investor $investor */
        $investor = Investor::find($id);

        if (empty($investor)) {
            //Flash::error('Investor not found');

            return redirect(route('sb.investors.index'));
        }

        return view('dmo-savings-bond-module::pages.investors.show')->with('investor', $investor);
    }

    /**
     * Show the form for editing the specified Investor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Organization $org, $id)
    {
        /** @var Investor $investor */
        $investor = Investor::find($id);

        if (empty($investor)) {
            //Flash::error('Investor not found');

            return redirect(route('sb.investors.index'));
        }

        return view('dmo-savings-bond-module::pages.investors.edit')->with('investor', $investor);
    }

    /**
     * Update the specified Investor in storage.
     *
     * @param  int              $id
     * @param UpdateInvestorRequest $request
     *
     * @return Response
     */
    public function update(Organization $org, $id, UpdateInvestorRequest $request)
    {
        /** @var Investor $investor */
        $investor = Investor::find($id);

        if (empty($investor)) {
            //Flash::error('Investor not found');

            return redirect(route('sb.investors.index'));
        }

        $investor->fill($request->all());
        $investor->save();

        //Flash::success('Investor updated successfully.');
        
        InvestorUpdated::dispatch($investor);
        return redirect(route('sb.investors.index'));
    }

    /**
     * Remove the specified Investor from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Organization $org, $id)
    {
        /** @var Investor $investor */
        $investor = Investor::find($id);

        if (empty($investor)) {
            //Flash::error('Investor not found');

            return redirect(route('sb.investors.index'));
        }

        $investor->delete();

        //Flash::success('Investor deleted successfully.');
        InvestorDeleted::dispatch($investor);
        return redirect(route('sb.investors.index'));
    }

        
    public function processBulkUpload(Organization $org, Request $request){

        $attachedFileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('uploads'), $attachedFileName);
        $path_to_file = public_path('uploads').'/'.$attachedFileName;

        //Process each line
        $loop = 1;
        $errors = [];
        $lines = file($path_to_file);

        if (count($lines) > 1) {
            foreach ($lines as $line) {
                
                if ($loop > 1) {
                    $data = explode(',', $line);
                    // if (count($invalids) > 0) {
                    //     array_push($errors, $invalids);
                    //     continue;
                    // }else{
                    //     //Check if line is valid
                    //     if (!$valid) {
                    //         $errors[] = $msg;
                    //     }
                    // }
                }
                $loop++;
            }
        }else{
            $errors[] = 'The uploaded csv file is empty';
        }
        
        if (count($errors) > 0) {
            return $this->sendError($this->array_flatten($errors), 'Errors processing file');
        }
        return $this->sendResponse($subject->toArray(), 'Bulk upload completed successfully');
    }
}
