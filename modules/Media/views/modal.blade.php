<div class="modal fade " tabindex="-1" role="dialog" id="dinhtrong-media-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-sm-7">
                        <ol class="breadcrumb">
                            <li  v-for="brc in breadcrumbs">
                                <a @click="load(brc.path)" href="javascript:void(0)">@{{brc.name}}</a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-5">
                        <ul class="list-inline">
                            <li><a href="javascript:void(0)" @click="remove()" :disabled="(directoriesChecked.length == 0 && filesChecked.length == 0)" class="btn btn-danger btn-sm">Delete</a></li>
                            <li><a href="javascript:void(0)" @click="loadCreateFolderModal()" class="btn btn-primary btn-sm">Create Folder</a></li>
                            <li>
                                <a href="javascript:void(0)" @click="upload()" id="upload-btn" class=" btn btn-primary btn-sm">Upload</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-12">
                        <div id="dinhtrong-media-progress-box"></div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th width="50">
                            <input type="checkbox" v-model="checkall" />
                        </th>
                        <th>
                            Name
                        </th>
                        <th  width="100px">
                            Size
                        </th>
                        <th  width="150px">
                            Modified
                        </th>
                    </tr>
                    <tr v-for="dir in directories">
                        <td>
                            <input v-model="directoriesChecked"  value="@{{dir.sortPath}}" type="checkbox" :checked="checkall" />
                        </td>
                        <td>
                            <a  @click="load(dir.sortPath)" href="javascript:void(0)">
                                <span class="glyphicon glyphicon-folder-open"> </span>&nbsp; @{{dir.name}}
                            </a>
                        </td>
                        <td>
                            @{{dir.size}}
                        </td>
                        <td>
                            @{{dir.modified}}
                        </td>
                    </tr>
                    <tr v-for="file in files">
                        <td>
                            <input v-model="filesChecked"  value="@{{file.sortPath}}" type="checkbox" :checked="checkall" />
                        </td>
                        <td>
                            <img v-if="file.thumbnail" v-bind:src="file.thumbnailUrl"  width="70px" />
                            <span v-if="!file.thumbnail" class="glyphicon glyphicon-file"> </span>&nbsp;
                            <a :href="file.assetUrl" target="_blank">
                                @{{file.name}}
                            </a>
                        </td>
                        <td>
                            @{{file.size}}
                        </td>
                        <td>
                             @{{file.modified}}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button @click="select()" :disabled=!canSelect type="button" class="btn btn-primary">Select</button>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>
    <div class="modal fade " tabindex="-1" role="dialog" id="dinhtrong-media-new-folder-modal" >
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Create new folder</h4>
                </div>
                <div class="modal-body">
                    <input type="text" v-model="newFolderName" class="form-control" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="hideCreateFolderModal()">Cancel</button>
                    <button type="button" class="btn btn-primary" @click="createNewFolder()">Create</button>
                </div>
            </div>
        </div>
    </div
</div>
