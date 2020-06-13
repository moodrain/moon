@extends('layout.app')
@section('title', 'Error')
@section('html')
    <div id="app">
        <br />
        <el-row>
            <el-col :span="8" :offset="8">
                <el-card>
                    <el-alert title="{{ $msg ?? 'Unknown Error'}}" :closable="false"></el-alert>
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
        }, 5000)
    </script>
@endsection