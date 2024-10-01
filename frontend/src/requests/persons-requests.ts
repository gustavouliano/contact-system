import { Person } from "@/@types/persons";

export const findAllPersons = async () => {
  const data = await fetch("http://localhost:8001/persons");
  const persons: Person[] = await data.json();
  return persons;
};

export const deletePerson = async (id: number) => {
  await fetch(`http://localhost:8001/persons/${id}`, {
    method: "DELETE",
  });
};

export const createPerson = async (personData: {
  name: string;
  cpf: string;
}) => {
  const formData = new FormData();
  formData.append("name", personData.name);
  formData.append("cpf", personData.cpf);

  const response = await fetch("http://localhost:8001/persons", {
    method: "POST",
    body: formData,
  });

  const newPerson: Person = await response.json();
  return newPerson;
};

export const updatePerson = async (
  id: number,
  personData: { name: string; cpf: string }
) => {
  const formData = new FormData();
  formData.append("name", personData.name);
  formData.append("cpf", personData.cpf);
  formData.append("_method", "PATCH");

  await fetch(`http://localhost:8001/persons/${id}`, {
    method: "POST",
    body: formData,
  });
};
