"use client";
import { Person } from "@/@types/persons";
import PersonTable from "@/components/Person/Table";
import { deletePerson, findAllPersons } from "@/requests/persons-requests";
import { useRouter } from "next/navigation";
import { useEffect, useState } from "react";

export default function Home() {
  const [persons, setPersons] = useState<Person[]>([]);

  const router = useRouter();

  const handlePersons = async () => {
    setPersons(await findAllPersons());
  };

  const onCreate = () => {
    router.push("/person/new");
  };

  const onView = (person: Person) => {
    router.push(`/person/${person.id}`);
  };

  const onEdit = (person: Person) => {
    router.push(
      `/person/edit?id=${person.id}&name=${person.name}&cpf=${person.cpf}`
    );
  };

  const onDelete = async (person: Person) => {
    await deletePerson(person.id);
    handlePersons();
  };

  useEffect(() => {
    handlePersons();
  }, []);

  return (
    <div className="flex flex-col mx-auto w-4/6 mt-4 gap-4 items-center">
      <h1 className="h2">Listagem de Pessoas</h1>
      <button className="btn btn-success mb-3" onClick={onCreate}>
        Criar nova pessoa
      </button>
      <PersonTable
        persons={persons}
        onView={onView}
        onEdit={onEdit}
        onDelete={onDelete}
      />
    </div>
  );
}
