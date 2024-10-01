import "./styles.css";
import { Contact } from "@/@types/contacts";

type Props = {
  contacts: Contact[];
  // onView: (contact: Contact) => void;
  onEdit: (contact: Contact) => void;
  onDelete: (contact: Contact) => void;
};

export default function ContactTable(props: Props) {
  return (
    <table className="table table-striped">
      <thead>
        <tr>
          <th scope="col">#ID</th>
          <th scope="col">Tipo</th>
          <th scope="col">Descrição</th>
        </tr>
      </thead>
      <tbody>
        {props.contacts.map((contact) => (
          <tr key={contact.id}>
            <th scope="row">#{contact.id}</th>
            <td>{contact.type}</td>
            <td>{contact.description}</td>
            <td>
              {/* <button
                className="btn btn-primary me-2 btn-sm"
                onClick={() => props.onView(contact)}
              >
                Visualizar
              </button> */}
              <button
                className="btn btn-warning me-2 btn-sm"
                onClick={() => props.onEdit(contact)}
              >
                Alterar
              </button>
              <button
                className="btn btn-danger btn-sm"
                onClick={() => props.onDelete(contact)}
              >
                Excluir
              </button>
            </td>
          </tr>
        ))}
      </tbody>
    </table>
  );
}
