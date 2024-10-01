import { Contact } from "@/@types/contacts";

export const findContactsFromPerson = async (personId: number) => {
  const data = await fetch(`http://localhost:8001/contacts/${personId}`);
  const contacts: Contact[] = await data.json();
  return contacts;
};

export const deleteContact = async (id: number) => {
  await fetch(`http://localhost:8001/contacts/${id}`, {
    method: "DELETE",
  });
};

export const createContact = async (personData: {
  type: boolean;
  description: string;
  personId: number;
}) => {
  const formData = new FormData();
  formData.append("type", personData.type ? "1" : "0");
  formData.append("description", personData.description);
  formData.append("personId", String(personData.personId));

  await fetch("http://localhost:8001/contacts", {
    method: "POST",
    body: formData,
  });
};

export const updateContact = async (
  id: number,
  personData: { type: boolean; description: string }
) => {
  const formData = new FormData();
  formData.append("type", personData.type ? "1" : "0");
  formData.append("description", personData.description);
  formData.append("_method", "PATCH");

  await fetch(`http://localhost:8001/contacts/${id}`, {
    method: "POST",
    body: formData,
  });
};
