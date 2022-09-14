<script src="{{ asset('assets/bt.min.js') }}"></script>

<script>
	$.gritter.add({
		title: "{{ isset($title) ? $title : '' }}",
		text: "{{ $message }}",
		class_name: "gritter-{{ $type }}" + (!$("#gritter-light").get(0) ? " gritter-light" : "")
	});
</script>