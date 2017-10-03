@extends('layouts.main')

@section('page-content')

    <!--page header links-->
    @include('partials.page-header-links')

	<div class="row header-title-tabs clearfix">
        <div class="header-title float-left">
            <h2>Tags</h2>
        </div>
        <!--<div class="question-tab-links float-right">

            {{--@include('partials.tabs.question-list-tabs')--}}

        </div> [RCT]-->
    </div>

    <div class="row">
    	<p class="tag-description">A tag is a keyword or label that categorizes your question with other, similar questions. Using the right tags makes it easier for others to find and answer your question.</p>
    </div>

    <!--<div class="row">
    	<form>
    		<div class="small-12">
    			<label>Type to find tags:
    			<input class="tag-locator" type="text" name="">
    		</label>
    		</div>
    	</form>
    </div> [RCT]-->

    <div class="container tags-list row ">

        @each('partials.tag-item', $allTags, 'tag')

    </div>
    <div class="row">
        <!-- pagination links -->
        <div class="tags-pagination">
            {{ $allTags->links() }}
        </div>
    </div>

@endsection
