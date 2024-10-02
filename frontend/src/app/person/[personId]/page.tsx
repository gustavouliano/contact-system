"use client";

import { Contact } from "@/@types/contacts";
import ContactTable from "@/components/Contact/Table";
import {
  deleteContact,
  findContactsFromPerson,
} from "@/requests/contacts-requests";
import { useRouter } from "next/navigation";
import { useEffect, useState } from "react";

export default function Page({ params }) {
  const [contacts, setContacts] = useState<Contact[]>([]);
  const router = useRouter();

  const handleContacts = async () => {
    setContacts(await findContactsFromPerson(params.personId));
  };

  const onCreate = () => {
    router.push(`/contact/new/${params.personId}`);
  };

  const onEdit = (contact: Contact) => {
    router.push(
      `/contact/edit?id=${contact.id}&type=${contact.type}&description=${contact.description}&personId=${params.personId}`
    );
  };

  const onDelete = async (contact: Contact) => {
    await deleteContact(contact.id);
    handleContacts();
  };

  useEffect(() => {
    handleContacts();
  }, []);

  return (
    <div className="flex flex-col mx-auto w-4/6 mt-4 gap-4 items-center">
      <h1 className="h2">
        Listagem de contatos da pessoa ID: {params.personId}
      </h1>
      <button className="btn btn-success mb-3" onClick={onCreate}>
        Adicionar contato
      </button>
      <ContactTable
        contacts={contacts}
        onEdit={onEdit}
        // onView={onView}
        onDelete={onDelete}
      />
    </div>
  );
}
