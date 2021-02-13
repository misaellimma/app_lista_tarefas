function removerTarefaTodas(id){
	location.href = '/todas_tarefas?acao=remover&id=' + id;
}

function editarTarefaTodas(id, tarefa){
	//criar um form de edição
	let form = document.createElement('form')
	form.action = '/todas_tarefas.php'
	form.method = 'post'
	form.className = 'row'

	//criar um input para entrada do texto
	let inputTarefa = document.createElement('input')
	inputTarefa.type = 'text'
	inputTarefa.name = 'tarefa'
	inputTarefa.className = 'col-md-9 form-control'
	inputTarefa.value = txt_tarefa

	//criar um input para entrada de texto
	let inputId = document.createElement('input')
	inputId.type = 'hidden'
	inputId.name = 'id'
	inputId.value = id

	//criar um button
	let button = document.createElement('button')
	button.type = 'submit'
	button.className = 'col-md-3 btn btn-info '
	button.innerHTML = 'Atualizar'

	//incluir o input no form
	form.appendChild(inputTarefa)

	//incluir o input no form
	form.appendChild(inputId)

	//incluir button no form
	form.appendChild(button)

	//selecionar a div tarefa
	let tarefa = document.getElementById('tarefa_' + id)

	//limpar o texto da tarefa
	tarefa.innerHTML= ''

	//incluir form na pagina
	tarefa.insertBefore(form, tarefa[0])
}

function marcarRealizadoTarefaTodas(id){
	location.href = '/todas_tarefas?acao=marcarRealizado&id=' + id;	
}