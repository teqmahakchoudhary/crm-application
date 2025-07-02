<tr role="row">
    <td><label><input type="checkbox" name="teams_checkbox[]" class="check_teams" data-id="{{ $team->id }}" value="{{ $team->id }}"><span></span></label></td>
    <td>{!! $team->new_name !!}</td>
    <td>{!! $team->team_count !!}
    <td>{!! $team->new_team_member !!}</td>
    <td>
        {!! $actionBtn !!}
    </td>
</tr>