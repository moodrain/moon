@extends('layout.app')
@section('title', 'Success')
@section('html')
    <div id="app">
        <br />
        <el-row>
            <el-col :span="8" :offset="8">
                <el-card>
                    <el-alert type="success" title="{{ $msg ?? 'Success' }}" :closable="false"></el-alert>
                    <el-divider></el-divider>
                    <el-button @click="back">Back</el-button>
                </el-card>
            </el-col>
        </el-row>
    </div>
@endsection

@section('js')
    <script>
        new Vue({
            el: '#app',
            methods: {
                back() {
                    history.back()
                }
            }
        })
        setTimeout(() => {
            history.back()
        }, 2000)
    </script>
@endsection