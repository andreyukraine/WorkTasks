<ul class="child_ul">

    @foreach($childs as $child)

        <li>
                <label class="tree-toggler nav-header">
                @if(count($child->childs))
                                <span id="{{ $child->id }}"><h4>{{ $child->name }}</h4></span>
                @else
                                <span id="{{ $child->id }}"><h4>{{ $child->name }}</h4></span>
                @endif
                        <div class="action_block">
                                <a href="{{ route('category.edit',$child->id) }}"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{{ route('delete.category',$child->id) }}"><span class="glyphicon glyphicon-remove"></span></a>
                        </div>
                </label>
            @if(count($child->childs))

                @include('category.subcat',['childs' => $child->childs])

            @endif

        </li>

    @endforeach

</ul>