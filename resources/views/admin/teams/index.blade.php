@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <div class="container">
        <div class="row">
            <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0">Teams</h5>
                <ol class="breadcrumbs mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Teams</li>
                </ol>
            </div>
            <div class="col s2 m6 l6">
                @can('team-add')
                    <a href="javascript:void(0)" class="btn amber darken-3 waves-effect waves-light add-team right">
                        <i class="bi bi-plus-circle"></i> Add Team
                    </a>
                @endcan
            </div>
        </div>
    </div>
</div>

<div class="col s12">
    <div class="container">
        <section class="users-list-wrapper section">
            <div class="card">
                <div class="card-content">
                    <div class="responsive-table">
                        <input type="hidden" id="teamsTypeAction" name="typeAction" value="">
                        <table id="team-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th class="checkbox-column dt-no-sorting" id="check_all">Record no.</th>
                                    <th>#</th>
                                    <th style="display: none">Id</th>
                                    <th>Team Name</th>
                                    <th>Total Members</th>
                                    <th>Team Members</th>
                                    <th style="display: none">Team Members</th>
                                    <th style="display: none">Created On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            @php
                $user = auth()->user();
                $canDelete = $user->can('team-delete');
                $canArchive = $user->can('Move-to-archive');
                $className = $canDelete ? '' : 'noPermission';
                $classNameArchive = $canArchive ? '' : 'noPermission';
                $title = $canDelete ? 'Delete' : \App\Helpers::displayMsgMultipleDelete();
                $titleArchive = $canArchive ? 'Archive' : \App\Helpers::displayMsgMultipleArchive();
            @endphp

            <div class="menu-component-wrapper" style="display: none;">
                <div class="batch-actions-menu-wrapper react-boards">
                    <div class="num-of-actions_wrapper">
                        <div class="num-of-actions">1</div>
                    </div>
                    <div class="batch-actions-title-section">
                        <div class="title">Teams selected</div>
                        <div class="pulses_dots">
                            @for ($i = 0; $i < 4; $i++)
                                <div class="dot" style="background: var(--primary-color);"></div>
                            @endfor
                        </div>
                    </div>
                    <div class="dialog-wrapper convert-to-subitems-wrapper">
                        <div class="{{ $classNameArchive }} batch-actions-item tooltipped" data-position="top" data-tooltip="{{ $titleArchive }}">
                            <span class="action-name teams-action-all" data-type="archive">
                                <i class="material-icons dp48">archive</i> Archive
                            </span>
                        </div>
                    </div>
                    <div class="dialog-wrapper convert-to-subitems-wrapper">
                        <div class="{{ $className }} batch-actions-item tooltipped" data-position="top" data-tooltip="{{ $title }}">
                            <span class="delete-icon1 action-name teams-action-all" data-type="delete">
                                <i class="material-icons dp48">delete</i> Delete
                            </span>
                        </div>
                    </div>
                    <div class="batch-actions-delete-item">
                        <i class="material-icons dp48">close</i>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="content-overlay"></div>
</div>

{{-- Team Details Sidebar --}}
<div class="email-compose-sidebar team-details small-sidebar style-sidebar">
    <div class="card quill-wrapper">
        <div class="card-content pt-0">
            <div class="card-header display-flex pb-2">
                <h3 class="card-title">Team Details</h3>
                <div class="action-btns">
                    <div class="edit-modal-icon edit-team-btn"></div>
                    <div class="close close-icon">
                        <i class="material-icons">close</i>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="loader-wrapper">
                    <div class="loader-container">
                        <div class="folding-cube loader-blue-grey">
                            <div class="cube1 cube"></div>
                            <div class="cube2 cube"></div>
                            <div class="cube4 cube"></div>
                            <div class="cube3 cube"></div>
                        </div>
                    </div>
                </div>
                <div class="team-details-data"></div>
            </div>
        </div>
    </div>
</div>

{{-- Team Edit Sidebar --}}
<div class="email-compose-sidebar team-edit-data small-sidebar style-sidebar">
    <div class="card quill-wrapper">
        <div class="card-content pt-0">
            <div class="card-header display-flex pb-2">
                <h3 class="card-title">Edit Team Details</h3>
                <div class="close close-icon">
                    <i class="material-icons">close</i>
                </div>
            </div>
            <form id="edit_team_form_data">
                <div class="loader-wrapper form-loader">
                    <div class="custom-loader">
                        <span class="loader"></span>
                    </div>
                </div>
                <div class="team-edit"></div>
            </form>
        </div>
    </div>
</div>
@endsection
