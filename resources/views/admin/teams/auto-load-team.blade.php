<tr role="row">
    <td><label><input type="checkbox" name="teams_checkbox[]" class="check_teams" data-id="{{ $newTeam->id }}" value="{{ $newTeam->id }}"><span></span></label></td>
    <td>{!! $newTeam->new_name !!}</td>
    <td>{!! $newTeam->team_count !!}
    <td>{!! $newTeam->new_team_member !!}</td>
    <td>
        {!! $actionBtn !!}
    </td>
</tr>