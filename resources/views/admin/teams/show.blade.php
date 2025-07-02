<section class="users-list-wrapper section">
    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12">
                        <table class="striped mt-0">
                            <tbody>
                                <tr>
                                    <td>Team Name:</td>
                                    <td>{{ ucfirst($team->name) }}</td>
                                </tr>
                                <tr>
                                    <td>Team Members:</td>
                                    <td class="users-view-latest-activity">
                                        @php
                                            $selectedMembers = json_decode($team->team_members);
                                        @endphp
                                        @if (!empty($selectedMembers))
                                            <span class="ml-2">
                                                @foreach($selectedMembers as $memberId)
                                                    <span class="chip shadow-none badge green-text removeTeamMember">
                                                        <a href="javascript:void(0)"
                                                           class="user-details btn-icon text-secondary"
                                                           data-id="{{ \App\Helpers::encryptId($memberId) }}">
                                                            <img class="circle" height="15" width="15"
                                                                 src="{{ url('storage/profile_image/' . \App\Helpers::getStaffMemberImage($memberId)) }}"
                                                                 alt="User" />
                                                            {{ ucfirst(\App\Helpers::userDetails($memberId)) }}
                                                        </a>
                                                        <a class="cross green-text"
                                                           data-name="{{ $memberId }}"
                                                           data-id="{{ $team->id }}"
                                                           data-teamid="{{ $team->id }}"
                                                           onclick="removeMember(this)">
                                                            <img style="height: 13px;" src="{{ url('images/cross.png') }}" alt="Remove" />
                                                        </a>
                                                    </span>
                                                @endforeach
                                            </span>
                                        @else
                                            <span class="ml-2">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Description:</td>
                                    <td class="users-view-verified">
                                        {{ !empty($team->description) ? ucfirst($team->description) : 'Not Provided' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
