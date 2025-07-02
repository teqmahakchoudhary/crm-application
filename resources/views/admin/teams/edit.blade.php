<div class="row custom-tabs">
    <input type="hidden" name="id" value="{{ $id }}">

    <div class="form-group col s12 m12">
        <label for="name" class="active">Team Name <span>*</span></label>
        <input
            type="text"
            id="name"
            name="title"
            maxlength="50"
            class="form-control team-name-height"
            value="{{ $team->name ?? 'Not Provided' }}"
        >
    </div>

    <div class="form-group col s12 m12">
        <label for="textarea1" class="active">Team Description</label>
        <textarea
            id="textarea1"
            name="description"
            class="form-control"
        >{{ $team->description }}</textarea>
    </div>

    @php $selectedMembers = json_decode($team->team_members); @endphp

    <div class="form-group col s12 m12">
        <label for="members">Team Members <span>*</span></label>
        @php $defaultSelected = \App\Helpers::checkSelectOrUnselectedTeam($selectedMembers, $staff); @endphp

        <select
            id="members"
            name="members[]"
            class="form-control select2 teamMultipleSelect"
            data-name="teamDefaultCheck"
            multiple
        >
            <option id="teamDefaultCheck" value="" {{ $defaultSelected }}>Select Team Member</option>
            @foreach ($staff as $user)
                <option
                    value="{{ $user->id }}"
                    @if(!empty($selectedMembers) && in_array($user->id, $selectedMembers)) selected @endif
                >
                    {{ ucfirst($user->name) . ' ' . ucfirst($user->last_name) }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="col s12 display-flex justify-content-end mt-2">
        <button type="submit" class="btn amber darken-3" id="update-team">
            <i class="bi bi-check2"></i> Update
        </button>
    </div>
</div>

<script>
    $(".select2.teamMultipleSelect").select2({
        dropdownAutoWidth: false,
        width: '100%',
        closeOnSelect: false,
        multiple: true,
    }).on("select2:selecting", function(e) {
        const id = $(this).data('name');
        $('#' + id).prop('selected', false);
    }).on("select2:unselecting", function(e) {
        const id = $(this).data('name');
        const selectedCount = $(this).find(':selected').length;
        if (selectedCount === 1) {
            $('#' + id).prop('selected', true);
        }
    });
</script>
