import { useState } from "react";
import { Person } from "@/@types/persons";
import "./styles.css";

type Props = {
  persons: Person[];
  onView: (person: Person) => void;
  onEdit: (person: Person) => void;
  onDelete: (person: Person) => void;
};

export default function PersonTable(props: Props) {
  const [searchTerm, setSearchTerm] = useState("");

  const filteredPersons = props.persons.filter((person) =>
    person.name.toLowerCase().includes(searchTerm.toLowerCase())
  );

  const handleSearchChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    setSearchTerm(event.target.value);
  };

  return (
    <div>
      <div className="mb-3">
        <input
          type="text"
          className="form-control"
          placeholder="Pesquisar por nome"
          value={searchTerm}
          onChange={handleSearchChange}
        />
      </div>
      <table className="table table-striped">
        <thead>
          <tr>
            <th scope="col">#ID</th>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          {filteredPersons.map((person) => (
            <tr key={person.id}>
              <th scope="row">#{person.id}</th>
              <td>{person.name}</td>
              <td>{person.cpf}</td>
              <td>
                <button
                  className="btn btn-primary me-2 btn-sm"
                  onClick={() => props.onView(person)}
                >
                  Visualizar contatos
                </button>
                <button
                  className="btn btn-warning me-2 btn-sm"
                  onClick={() => props.onEdit(person)}
                >
                  Alterar
                </button>
                <button
                  className="btn btn-danger btn-sm"
                  onClick={() => props.onDelete(person)}
                >
                  Excluir
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
