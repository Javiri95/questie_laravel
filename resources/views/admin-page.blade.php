
@extends('layouts.layout')

@section('title', 'Admin Page')

@section('header', 'Panel de Administración')

@section('content')

    <div class="container mt-4">
        <!-- Tabla de Usuarios -->
        <h2>Usuarios</h2>
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apodo</th>
                        <th scope="col">Correo Electrónico</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Fecha de Creación</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->nickname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->birth_date }}</td>
                            <td>
                                @if ($user->avatar)
                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}'s avatar" width="50" class="img-fluid">
                                @else
                                    No Avatar
                                @endif
                            </td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                            <td style="display:flex">
                                <button class="btn btn-outline-secondary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">Editar</button>
                                <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}">Eliminar</button>
                            </td>
                        </tr>

                        <!-- Edit User Modal -->
                        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Editar Usuario</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Nombre</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nickname">Apodo</label>
                                                <input type="text" class="form-control" id="nickname" name="nickname" value="{{ $user->nickname }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Correo Electrónico</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="birth_date">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ $user->birth_date }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Rol</label>
                                                <input type="text" class="form-control" id="role" name="role" value="{{ $user->role }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete User Modal -->
                        <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteUserModalLabel{{ $user->id }}">Eliminar Usuario</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que deseas eliminar a este usuario?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tabla de Preguntas -->
        <h2 class="mt-5 mb-4">Preguntas</h2>
        <!-- Botón para abrir el modal de añadir pregunta -->
        <button type="button" style="margin-bottom:15px;" class="btn btn-outline-secondary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
            Añadir Pregunta
        </button>

        <!-- Modal para añadir pregunta -->
        <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addQuestionModalLabel">Añadir Pregunta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('questions.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="question" class="form-label">Pregunta</label>
                                <input type="text" class="form-control" id="question" name="question" required>
                            </div>
                            <div class="mb-3">
                                <label for="option_a" class="form-label">Opción A</label>
                                <input type="text" class="form-control" id="option_a" name="option_a" required>
                            </div>
                            <div class="mb-3">
                                <label for="option_b" class="form-label">Opción B</label>
                                <input type="text" class="form-control" id="option_b" name="option_b" required>
                            </div>
                            <div class="mb-3">
                                <label for="option_c" class="form-label">Opción C</label>
                                <input type="text" class="form-control" id="option_c" name="option_c" required>
                            </div>
                            <div class="mb-3">
                                <label for="correct_option" class="form-label">Opción Correcta</label>
                                <input type="text" class="form-control" id="correct_option" name="correct_option" required>
                            </div>
                            <div class="mb-3">
                                <label for="media_url" class="form-label">Medios Asociados (URL)</label>
                                <p>Asegúrate de añadir una direccion válida</p>
                                <input type="text" class="form-control" id="media_url" name="media_url">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="margin-bottom:100px;" class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table  class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pregunta</th>
                        <th scope="col">Opción A</th>
                        <th scope="col">Opción B</th>
                        <th scope="col">Opción C</th>
                        <th scope="col">Opción Correcta</th>
                        <th scope="col">Medios Asociados</th>
                        <th scope="col">Fecha de Creación</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            <th scope="row">{{ $question->id }}</th>
                            <td>{{ $question->question }}</td>
                            <td>{{ $question->option_a }}</td>
                            <td>{{ $question->option_b }}</td>
                            <td>{{ $question->option_c }}</td>
                            <td>{{ $question->correct_option }}</td>
                            <td>
                                @if ($question->media_url)
                                    <a href="{{ $question->media_url }}" target="_blank">Ver Medios</a>
                                @else
                                    No Medios
                                @endif
                            </td>
                            <td>{{ $question->created_at->format('d-m-Y H:i') }}</td>
                            <td style="display:flex">
                                <button class="btn btn-outline-secondary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editQuestionModal{{ $question->id }}">Editar</button>
                                <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal{{ $question->id }}">Eliminar</button>
                            </td>
                        </tr>

                        <!-- Edit Question Modal -->
                        <div class="modal fade" id="editQuestionModal{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="editQuestionModalLabel{{ $question->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editQuestionModalLabel{{ $question->id }}">Editar Pregunta</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('questions.update', $question->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="question">Pregunta</label>
                                                <input type="text" class="form-control" id="question" name="question" value="{{ $question->question }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="option_a">Opción A</label>
                                                <input type="text" class="form-control" id="option_a" name="option_a" value="{{ $question->option_a }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="option_b">Opción B</label>
                                                <input type="text" class="form-control" id="option_b" name="option_b" value="{{ $question->option_b }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="option_c">Opción C</label>
                                                <input type="text" class="form-control" id="option_c" name="option_c" value="{{ $question->option_c }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="correct_option" class="form-label">Opción Correcta</label>
                                                <select class="form-control" id="correct_option" name="correct_option" required>
                                                    <option value="">Seleccione una opción</option>
                                                    <option value="option_a">Opción A</option>
                                                    <option value="option_b">Opción B</option>
                                                    <option value="option_c">Opción C</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="media_url">Medios Asociados</label>
                                                <input type="text" class="form-control" id="media_url" name="media_url" value="{{ $question->media_url }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Question Modal -->
                        <div class="modal fade" id="deleteQuestionModal{{ $question->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteQuestionModalLabel{{ $question->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteQuestionModalLabel{{ $question->id }}">Eliminar Pregunta</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que deseas eliminar esta pregunta?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Incluye jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection




