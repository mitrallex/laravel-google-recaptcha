@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    Feedback Form
                </div>
                <div class="card-body">
                    <form action="{{ action('FeedbackController@store') }}" method="post">

                        {{ csrf_field()  }}

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input v-model="form.name" class="form-control" :class="{ 'is-invalid': hasError('name') }" id="name" type="text" name="name" placeholder="Name" required>
                            <div v-if="hasError('name')" class="invalid-feedback">@{{ getError('name') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input v-model="form.email" class="form-control" :class="{ 'is-invalid': hasError('email') }" id="email" type="email" name="email" placeholder="Email" required>
                            <div v-if="hasError('email')" class="invalid-feedback">@{{ getError('email') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea v-model="form.message" class="form-control" :class="{ 'is-invalid': hasError('message') }" id="message" row="3" placeholder="Message"></textarea>
                            <div v-if="hasError('message')" class="invalid-feedback">@{{ getError('message') }}</div>
                        </div>
                        <div class="form-group float-left">
                            <div class="g-recaptcha" id="feedback-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY')  }}"></div>
                        </div>
                        <div class="form-group float-right btn-feedback-block">
                            <button @click.prevent="leaveFeedback()" type="submit" class="btn btn-outline-primary btn-lg">Leave feedback</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection