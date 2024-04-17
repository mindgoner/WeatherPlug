<?php

namespace App\Http\Controllers\relations;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\user_group_relations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class user_group_relationsController extends Controller
{
    public function create()
    {
        
        return view('admin.relations.create_relations');
    }

    // Wyświetlanie użytkowników do dodania
    public function show( Request $request)
    {
        // Pobierz ID zalogowanego użytkownika
        $loggedInUserId = Auth::id();
        $groupId = $request->query('id');
        $isAdmin = user_group_relations::where('userId', $loggedInUserId)
                                       ->where('groupId', $groupId)
                                       ->where('status', 'admin')
                                       ->exists();
        
        // Jeśli użytkownik nie jest administratorem tej grupy, przekieruj lub zwróć odpowiedni komunikat
        if (!$isAdmin) {
            return redirect()->back()->with('error', 'You do not have permission to edit this group.');
        }
        
        // Pobierz wszystkich użytkowników, z wyjątkiem zalogowanego użytkownika
        $users = User::where('id', '!=', $loggedInUserId)->get();

        $id = $request->query('id');
        
        // Przekaż dane użytkowników do widoku
        return view('admin.relations.show_relations', ['id' => $id], compact('users'));
    }

    // Dodawanie użytkowników 
    public function addMember(Request $request)
    {
        $sensorUserID = $request->input('userId');
        $senorGroupId = $request->input('groupId');
    
        // Sprawdź, czy relacja między użytkownikiem a grupą już istnieje
        $existingRelation = user_group_relations::where('userId', $sensorUserID)
                                                 ->where('groupId', $senorGroupId)
                                                 ->first();
    
        // Sprawdź, czy użytkownik ma status "admin" w tej grupie
        $isAdmin = user_group_relations::where('userId', $sensorUserID)
                                        ->where('groupId', $senorGroupId)
                                        ->where('status', 'admin')
                                        ->exists();
    
        // Jeśli relacja już istnieje, zakończ funkcję
        if ($existingRelation) {
            return redirect()->back()->with('error', 'This user is already a member of the group.');
        }
    
        // Jeśli użytkownik ma status "admin", nie dodawaj go ponownie
        if ($isAdmin) {
            return redirect()->back()->with('error', 'Admin user cannot be added to the group again.');
        }
    
        // Jeśli relacja nie istnieje i użytkownik nie jest adminem, dodaj nową relację
        $newRelation = new user_group_relations();
        $newRelation->userId = $sensorUserID;
        $newRelation->groupId =  $senorGroupId;
        $newRelation->status = "member";
        $newRelation->save();
    
        return redirect()->back()->with('success', 'User added to the group successfully.');
    }
    // Wyświetlanie użytkowników do edycji (usuwania)
    public function removeUserFromColabsShow(Request $request)
    {
        // Pobierz ID zalogowanego użytkownika
        $loggedInUserId = Auth::id();
    
        // Pobierz ID grupy z żądania
        $groupId = $request->query('id');
        $isAdmin = user_group_relations::where('userId', $loggedInUserId)
                                       ->where('groupId', $groupId)
                                       ->where('status', 'admin')
                                       ->exists();
        
        // Jeśli użytkownik nie jest administratorem tej grupy, przekieruj lub zwróć odpowiedni komunikat
        if (!$isAdmin) {
            return redirect()->back()->with('error', 'You do not have permission to edit this group.');
        }
         // Pobierz użytkowników należących do tej grupy (wykluczając zalogowanego użytkownika)
        $users = user_group_relations::where('groupId', $groupId)->where('status', 'member')->get();
        return view('admin.relations.edit', compact('groupId', 'users'));
    }

    //Usuwanie użytkownika z colaboration 
    public function deleteUser($id)
    {        
         // Pobierz użytkownika, którego chcesz usunąć
         $user = user_group_relations::find($id);
    
         $user->delete();
    
         return redirect()->back()->with('success', 'User deleted successfully.');
    }

    

}